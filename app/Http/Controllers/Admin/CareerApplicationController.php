<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\ManageCareerApplication;
use App\Actions\Admin\UpdateEnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CareerApplicationRequest;
use App\Http\Requests\Admin\UpdateEnquiryStatusRequest;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CareerApplicationController extends Controller
{
    /**
     * Display a listing of career applications.
     */
    public function index(): View
    {
        return view('admin.pages.enquiries.career-applications.index', [
            'applications' => CareerApplication::query()
                ->with('career:id,job_title')
                ->latest()
                ->orderByDesc('id')
                ->paginate(15),
        ]);
    }

    /**
     * Display a career application.
     */
    public function show(CareerApplication $careerApplication): View
    {
        $careerApplication->load('career:id,job_title');

        return view('admin.pages.enquiries.show', [
            'title' => 'Career application',
            'subtitle' => 'Review this application and update its status',
            'eyebrow' => 'Career',
            'heading' => $careerApplication->name,
            'record' => $careerApplication,
            'statusAction' => route('admin.career-applications.status', $careerApplication),
            'indexRoute' => 'admin.career-applications.index',
            'editRoute' => route('admin.career-applications.edit', $careerApplication),
            'resumeUrl' => route('admin.career-applications.resume', $careerApplication),
            'rows' => [
                ['label' => 'Email', 'value' => $careerApplication->email],
                ['label' => 'Mobile', 'value' => $careerApplication->mobile],
                ['label' => 'Job', 'value' => $careerApplication->career->job_title],
                ['label' => 'Received', 'value' => $careerApplication->created_at?->format('d M Y, h:i A')],
            ],
        ]);
    }

    /**
     * Show the form for creating a career application.
     */
    public function create(): View
    {
        return view('admin.pages.enquiries.career-applications.form', [
            'title' => 'Add career application',
            'subtitle' => 'Record an application received outside the website',
            'action' => route('admin.career-applications.store'),
            'record' => null,
            'submitLabel' => 'Save application',
            'careers' => $this->careers(),
        ]);
    }

    /**
     * Store a newly created career application.
     */
    public function store(CareerApplicationRequest $request, ManageCareerApplication $applications): RedirectResponse
    {
        $resume = $request->file('resume');

        if (! $resume instanceof UploadedFile) {
            abort(422);
        }

        $applications->create(
            $request->safe()->only(['career_id', 'name', 'email', 'mobile']),
            $resume,
        );

        return redirect()->route('admin.career-applications.index')->with('status', 'career-application-created');
    }

    /**
     * Show the form for editing a career application.
     */
    public function edit(CareerApplication $careerApplication): View
    {
        $careerApplication->load('career:id,job_title');

        return view('admin.pages.enquiries.career-applications.form', [
            'title' => 'Edit career application',
            'subtitle' => 'Update this career application',
            'action' => route('admin.career-applications.update', $careerApplication),
            'record' => $careerApplication,
            'submitLabel' => 'Update application',
            'careers' => $this->careers(),
        ]);
    }

    /**
     * Update the specified career application.
     */
    public function update(CareerApplicationRequest $request, CareerApplication $careerApplication, ManageCareerApplication $applications): RedirectResponse
    {
        $resume = $request->file('resume');

        $applications->update(
            $careerApplication,
            $request->safe()->only(['career_id', 'name', 'email', 'mobile']),
            $resume instanceof UploadedFile ? $resume : null,
        );

        return redirect()->route('admin.career-applications.index')->with('status', 'career-application-updated');
    }

    /**
     * Update the status and optional admin message.
     */
    public function updateStatus(UpdateEnquiryStatusRequest $request, CareerApplication $careerApplication, UpdateEnquiryStatus $followUp): RedirectResponse
    {
        $result = $followUp->handle(
            $careerApplication,
            $request->integer('status'),
            $request->adminMessage(),
            $request->boolean('send_email'),
            $careerApplication->name,
            'your career application',
        );

        return redirect()
            ->route('admin.career-applications.show', $careerApplication)
            ->with('status', 'enquiry-status-'.$result);
    }

    /**
     * Remove the specified career application.
     */
    public function destroy(CareerApplication $careerApplication, ManageCareerApplication $applications): RedirectResponse
    {
        $applications->delete($careerApplication);

        return redirect()->route('admin.career-applications.index')->with('status', 'career-application-deleted');
    }

    /**
     * Stream the stored resume from the disk recorded on the application.
     */
    public function resume(CareerApplication $careerApplication): StreamedResponse
    {
        abort_unless(
            Storage::disk($careerApplication->resume_disk)->exists($careerApplication->resume_path),
            404,
        );

        $extension = pathinfo($careerApplication->resume_path, PATHINFO_EXTENSION);
        $filename = 'resume-'.$careerApplication->getKey().($extension !== '' ? '.'.$extension : '');

        return Storage::disk($careerApplication->resume_disk)->response(
            $careerApplication->resume_path,
            $filename,
        );
    }

    /**
     * @return Collection<int, Career>
     */
    private function careers(): Collection
    {
        return Career::query()->orderBy('job_title')->orderBy('id')->get(['id', 'job_title']);
    }
}
