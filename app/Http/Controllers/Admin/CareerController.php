<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CareerRequest;
use App\Models\Career;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerController extends Controller
{
    /**
     * Display a listing of job openings.
     */
    public function index(): View
    {
        return view('admin.pages.careers.index', [
            'careers' => Career::query()->withCount('applications')->latest()->orderByDesc('id')->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a job opening.
     */
    public function create(): View
    {
        return view('admin.pages.careers.form', [
            'title' => 'Add job opening',
            'subtitle' => 'Publish a role on the careers page',
            'action' => route('admin.careers.store'),
            'record' => null,
            'submitLabel' => 'Save job',
        ]);
    }

    /**
     * Store a newly created job opening.
     */
    public function store(CareerRequest $request): RedirectResponse
    {
        Career::query()->create($request->safe()->only([
            'job_title',
            'job_description',
            'eligible_criteria',
            'key_responsibilities',
            'salary',
            'location',
            'last_application_date',
        ]));

        return redirect()->route('admin.careers.index')->with('status', 'career-created');
    }

    /**
     * Show the form for editing a job opening.
     */
    public function edit(Career $career): View
    {
        return view('admin.pages.careers.form', [
            'title' => 'Edit job opening',
            'subtitle' => 'Update this role',
            'action' => route('admin.careers.update', $career),
            'record' => $career,
            'submitLabel' => 'Update job',
        ]);
    }

    /**
     * Update the specified job opening.
     */
    public function update(CareerRequest $request, Career $career): RedirectResponse
    {
        $career->update($request->safe()->only([
            'job_title',
            'job_description',
            'eligible_criteria',
            'key_responsibilities',
            'salary',
            'location',
            'last_application_date',
        ]));

        return redirect()->route('admin.careers.index')->with('status', 'career-updated');
    }

    /**
     * Remove the specified job opening.
     */
    public function destroy(Career $career): RedirectResponse
    {
        if ($career->applications()->exists()) {
            return back()->with('status', 'career-has-applications');
        }

        $career->delete();

        return redirect()->route('admin.careers.index')->with('status', 'career-deleted');
    }
}
