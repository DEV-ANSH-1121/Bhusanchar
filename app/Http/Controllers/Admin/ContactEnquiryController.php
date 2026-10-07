<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\UpdateEnquiryStatus;
use App\Enums\InquiryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactEnquiryRequest;
use App\Http\Requests\Admin\UpdateEnquiryStatusRequest;
use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of contact enquiries.
     */
    public function index(): View
    {
        return view('admin.pages.enquiries.contact.index', [
            'enquiries' => ContactEnquiry::query()->latest()->orderByDesc('id')->paginate(15),
        ]);
    }

    /**
     * Display a contact enquiry.
     */
    public function show(ContactEnquiry $contactEnquiry): View
    {
        return view('admin.pages.enquiries.show', [
            'title' => 'Contact enquiry',
            'subtitle' => 'Review this message and update its status',
            'eyebrow' => 'Contact Us',
            'heading' => $contactEnquiry->name,
            'record' => $contactEnquiry,
            'statusAction' => route('admin.contact-enquiries.status', $contactEnquiry),
            'indexRoute' => 'admin.contact-enquiries.index',
            'editRoute' => route('admin.contact-enquiries.edit', $contactEnquiry),
            'rows' => [
                ['label' => 'Email', 'value' => $contactEnquiry->email],
                ['label' => 'Mobile', 'value' => $contactEnquiry->mobile],
                ['label' => 'Product interested', 'value' => $contactEnquiry->product_interested],
                ['label' => 'State', 'value' => $contactEnquiry->state],
                ['label' => 'District', 'value' => $contactEnquiry->district],
                ['label' => 'Block', 'value' => $contactEnquiry->block],
                ['label' => 'Inquiry type', 'value' => $contactEnquiry->inquiry_type->label()],
                ['label' => 'Received', 'value' => $contactEnquiry->created_at?->format('d M Y, h:i A')],
                ['label' => 'Message', 'value' => $contactEnquiry->message, 'wide' => true],
            ],
        ]);
    }

    /**
     * Show the form for creating a contact enquiry.
     */
    public function create(): View
    {
        return view('admin.pages.enquiries.contact.form', [
            'title' => 'Add contact enquiry',
            'subtitle' => 'Record a message received by phone or in person',
            'action' => route('admin.contact-enquiries.store'),
            'record' => null,
            'submitLabel' => 'Save enquiry',
            'inquiryTypes' => InquiryType::cases(),
        ]);
    }

    /**
     * Store a newly created contact enquiry.
     */
    public function store(ContactEnquiryRequest $request): RedirectResponse
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

        return redirect()->route('admin.contact-enquiries.index')->with('status', 'contact-enquiry-created');
    }

    /**
     * Show the form for editing a contact enquiry.
     */
    public function edit(ContactEnquiry $contactEnquiry): View
    {
        return view('admin.pages.enquiries.contact.form', [
            'title' => 'Edit contact enquiry',
            'subtitle' => 'Update this contact message',
            'action' => route('admin.contact-enquiries.update', $contactEnquiry),
            'record' => $contactEnquiry,
            'submitLabel' => 'Update enquiry',
            'inquiryTypes' => InquiryType::cases(),
        ]);
    }

    /**
     * Update the specified contact enquiry.
     */
    public function update(ContactEnquiryRequest $request, ContactEnquiry $contactEnquiry): RedirectResponse
    {
        $contactEnquiry->update($request->safe()->only([
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

        return redirect()->route('admin.contact-enquiries.index')->with('status', 'contact-enquiry-updated');
    }

    /**
     * Update the status and optional admin message.
     */
    public function updateStatus(UpdateEnquiryStatusRequest $request, ContactEnquiry $contactEnquiry, UpdateEnquiryStatus $followUp): RedirectResponse
    {
        $result = $followUp->handle(
            $contactEnquiry,
            $request->integer('status'),
            $request->adminMessage(),
            $request->boolean('send_email'),
            $contactEnquiry->name,
            'your contact enquiry',
        );

        return redirect()
            ->route('admin.contact-enquiries.show', $contactEnquiry)
            ->with('status', 'enquiry-status-'.$result);
    }

    /**
     * Remove the specified contact enquiry.
     */
    public function destroy(ContactEnquiry $contactEnquiry): RedirectResponse
    {
        $contactEnquiry->delete();

        return redirect()->route('admin.contact-enquiries.index')->with('status', 'contact-enquiry-deleted');
    }
}
