<?php

use App\Models\Admin;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

/**
 * A small PDF that file-type detection accepts as application/pdf.
 */
function careerResumeUpload(): UploadedFile
{
    $pdf = "%PDF-1.1\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Count 0/Kids[]>>endobj\ntrailer<</Root 1 0 R>>\n%%EOF";

    return UploadedFile::fake()->createWithContent('resume.pdf', $pdf);
}

it('redirects guests away from a stored resume', function () {
    $application = CareerApplication::factory()->create();

    $this->get(route('admin.career-applications.resume', $application))
        ->assertRedirect(route('admin.login'));
});

it('renders the career application form', function () {
    $admin = Admin::factory()->create();
    Career::factory()->create(['job_title' => 'Block Officer']);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.career-applications.create'))
        ->assertSee('Block Officer', false)
        ->assertSee('PDF, DOC, or DOCX', false);
});

it('stores a resume on the default disk and ignores a submitted path', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $career = Career::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.career-applications.store'), [
            'career_id' => $career->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'mobile' => '9801892639',
            'resume' => careerResumeUpload(),
            'resume_path' => 'ignored/secret.pdf',
            'resume_disk' => 'public',
        ])
        ->assertRedirect(route('admin.career-applications.index'))
        ->assertSessionHas('status', 'career-application-created');

    $application = CareerApplication::query()->first();

    expect($application)->not->toBeNull()
        ->and($application->resume_path)->not->toBe('ignored/secret.pdf')
        ->and($application->resume_disk)->toBe(config('filesystems.default'))
        ->and($application->career_id)->toBe($career->id);

    Storage::disk($application->resume_disk)->assertExists($application->resume_path);
});

it('rejects a resume that is not a pdf or word document', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $career = Career::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.career-applications.create'))
        ->post(route('admin.career-applications.store'), [
            'career_id' => $career->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'mobile' => '9801892639',
            'resume' => UploadedFile::fake()->create('notes.txt', 20, 'text/plain'),
        ])
        ->assertRedirect(route('admin.career-applications.create'))
        ->assertSessionHasErrors('resume');

    $this->assertDatabaseCount('career_applications', 0);
    expect(Storage::disk(config('filesystems.default'))->allFiles())->toBe([]);
});

it('keeps the existing resume when an application is updated without a new file', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $path = 'career-applications/keep.pdf';
    Storage::disk(config('filesystems.default'))->put($path, 'keep-resume');
    $application = CareerApplication::factory()->create([
        'resume_path' => $path,
        'resume_disk' => config('filesystems.default'),
    ]);

    $this->actingAs($admin, 'admin')
        ->put(route('admin.career-applications.update', $application), [
            'career_id' => $application->career_id,
            'name' => 'Updated Applicant',
            'email' => 'updated@example.com',
            'mobile' => '9800000000',
        ])
        ->assertRedirect(route('admin.career-applications.index'))
        ->assertSessionHas('status', 'career-application-updated');

    expect($application->refresh()->resume_path)->toBe($path)
        ->and($application->name)->toBe('Updated Applicant');

    Storage::disk(config('filesystems.default'))->assertExists($path);
});

it('replaces the resume and deletes the previous file', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $previousPath = 'career-applications/previous.pdf';
    Storage::disk(config('filesystems.default'))->put($previousPath, 'previous-resume');
    $application = CareerApplication::factory()->create([
        'resume_path' => $previousPath,
        'resume_disk' => config('filesystems.default'),
    ]);

    $this->actingAs($admin, 'admin')
        ->put(route('admin.career-applications.update', $application), [
            'career_id' => $application->career_id,
            'name' => $application->name,
            'email' => $application->email,
            'mobile' => $application->mobile,
            'resume' => careerResumeUpload(),
        ])
        ->assertRedirect(route('admin.career-applications.index'));

    $application->refresh();

    expect($application->resume_path)->not->toBe($previousPath);
    Storage::disk(config('filesystems.default'))->assertMissing($previousPath);
    Storage::disk($application->resume_disk)->assertExists($application->resume_path);
});

it('deletes the application and its resume', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $path = 'career-applications/delete-me.pdf';
    Storage::disk(config('filesystems.default'))->put($path, 'delete-resume');
    $application = CareerApplication::factory()->create([
        'resume_path' => $path,
        'resume_disk' => config('filesystems.default'),
    ]);

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.career-applications.destroy', $application))
        ->assertRedirect(route('admin.career-applications.index'))
        ->assertSessionHas('status', 'career-application-deleted');

    $this->assertModelMissing($application);
    Storage::disk(config('filesystems.default'))->assertMissing($path);
});

it('streams a stored resume for an authenticated admin', function () {
    Storage::fake(config('filesystems.default'));

    $admin = Admin::factory()->create();
    $path = 'career-applications/stream.pdf';
    Storage::disk(config('filesystems.default'))->put($path, 'resume-bytes');
    $application = CareerApplication::factory()->create([
        'resume_path' => $path,
        'resume_disk' => config('filesystems.default'),
    ]);

    $response = $this->actingAs($admin, 'admin')
        ->get(route('admin.career-applications.resume', $application));

    $response->assertOk();
    expect($response->streamedContent())->toBe('resume-bytes');
});
