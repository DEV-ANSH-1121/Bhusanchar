<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\View\View;

class CareerController extends Controller
{
    /**
     * Display job openings that are still accepting applications.
     */
    public function index(): View
    {
        return view('frontend.pages.careers', [
            'careers' => Career::query()
                ->acceptingApplications()
                ->orderBy('last_application_date')
                ->orderBy('id')
                ->get(),
        ]);
    }
}
