<?php

namespace App\Http\Controllers;

use App\Actions\Admin\ManageCareerApplication;
use App\Http\Requests\StoreCareerApplicationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;

class CareerApplicationController extends Controller
{
    /**
     * Store a career application from the public careers page.
     */
    public function store(StoreCareerApplicationRequest $request, ManageCareerApplication $applications): RedirectResponse
    {
        $resume = $request->file('resume');

        if (! $resume instanceof UploadedFile) {
            abort(422);
        }

        $applications->create(
            $request->safe()->only(['career_id', 'name', 'email', 'mobile']),
            $resume,
        );

        return redirect()->route('careers')->with('status', 'career-application-submitted');
    }
}
