<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactEnquiryRequest;
use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;

class ContactEnquiryController extends Controller
{
    /**
     * Store a contact enquiry from the public form.
     */
    public function store(StoreContactEnquiryRequest $request): RedirectResponse
    {
        ContactEnquiry::query()->create($request->safe()->only([
            'name',
            'email',
            'mobile',
            'product_interested',
            'state',
            'district',
            'block',
            'inquiry_type',
            'message',
        ]));

        return back()->with('status', 'contact-submitted');
    }
}
