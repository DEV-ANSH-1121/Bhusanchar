<?php

namespace App\Actions\Admin;

use App\Models\CareerApplication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ManageCareerApplication
{
    /**
     * Store a resume on the default filesystem disk and remember that disk.
     * Existing files stay readable after FILESYSTEM_DISK is switched to s3.
     *
     * @param  array{career_id: int|string, name: string, email: string, mobile: string}  $attributes
     */
    public function create(array $attributes, UploadedFile $resume): CareerApplication
    {
        $disk = (string) config('filesystems.default');
        $path = $this->storeResume($resume, $disk);

        try {
            return CareerApplication::query()->create([
                ...$attributes,
                'resume_path' => $path,
                'resume_disk' => $disk,
            ]);
        } catch (Throwable $exception) {
            $this->deleteResume($disk, $path);

            throw $exception;
        }
    }

    /**
     * @param  array{career_id: int|string, name: string, email: string, mobile: string}  $attributes
     */
    public function update(CareerApplication $application, array $attributes, ?UploadedFile $resume = null): CareerApplication
    {
        $disk = (string) config('filesystems.default');
        $newPath = $resume instanceof UploadedFile ? $this->storeResume($resume, $disk) : null;
        $previousDisk = $application->resume_disk;
        $previousPath = $application->resume_path;

        try {
            $application->update([
                ...$attributes,
                ...($newPath !== null ? ['resume_path' => $newPath, 'resume_disk' => $disk] : []),
            ]);
        } catch (Throwable $exception) {
            if ($newPath !== null) {
                $this->deleteResume($disk, $newPath);
            }

            throw $exception;
        }

        if ($newPath !== null) {
            $this->deleteResume($previousDisk, $previousPath);
        }

        return $application;
    }

    public function delete(CareerApplication $application): void
    {
        $disk = $application->resume_disk;
        $path = $application->resume_path;

        $application->delete();

        $this->deleteResume($disk, $path);
    }

    private function storeResume(UploadedFile $resume, string $disk): string
    {
        $path = $resume->store('career-applications', $disk);

        if ($path === false) {
            throw new RuntimeException('Unable to store the resume.');
        }

        return $path;
    }

    private function deleteResume(string $disk, string $path): void
    {
        if ($path === '') {
            return;
        }

        Storage::disk($disk)->delete($path);
    }
}
