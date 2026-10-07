<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the admin profile form.
     */
    public function edit(): View
    {
        return view('admin.pages.profile.edit', [
            'admin' => auth('admin')->user(),
        ]);
    }

    /**
     * Update the authenticated admin's profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $request->user('admin')->update($request->safe()->only(['name', 'email']));

        return back()->with('status', 'profile-updated');
    }
}
