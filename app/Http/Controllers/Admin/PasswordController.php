<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    /**
     * Update the authenticated admin's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $request->user('admin')->update($request->safe()->only(['password']));

        return back()->with('status', 'password-updated');
    }
}
