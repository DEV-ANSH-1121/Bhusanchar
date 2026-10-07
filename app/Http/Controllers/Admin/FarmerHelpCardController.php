<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\UpdateEnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FarmerHelpCardRequest;
use App\Http\Requests\Admin\UpdateEnquiryStatusRequest;
use App\Models\FarmerHelpCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FarmerHelpCardController extends Controller
{
    /**
     * Display a listing of farmer help card applications.
     */
    public function index(): View
    {
        return view('admin.pages.enquiries.farmer-help-cards.index', [
            'applications' => FarmerHelpCard::query()->latest()->orderByDesc('id')->paginate(15),
        ]);
    }

    /**
     * Display a farmer help card application.
     */
    public function show(FarmerHelpCard $farmerHelpCard): View
    {
        return view('admin.pages.enquiries.show', [
            'title' => 'Farmer help card',
            'subtitle' => 'Review this application and update its status',
            'eyebrow' => 'Farmer Help Card',
            'heading' => $farmerHelpCard->name,
            'record' => $farmerHelpCard,
            'statusAction' => route('admin.farmer-help-cards.status', $farmerHelpCard),
            'indexRoute' => 'admin.farmer-help-cards.index',
            'editRoute' => route('admin.farmer-help-cards.edit', $farmerHelpCard),
            'rows' => [
                ['label' => 'Email', 'value' => $farmerHelpCard->email],
                ['label' => 'Mobile', 'value' => $farmerHelpCard->mobile],
                ['label' => 'State', 'value' => $farmerHelpCard->state],
                ['label' => 'District', 'value' => $farmerHelpCard->district],
                ['label' => 'Block', 'value' => $farmerHelpCard->block],
                ['label' => 'Village', 'value' => $farmerHelpCard->village],
                ['label' => 'Preferred BhuSanchar point', 'value' => $farmerHelpCard->preferred_bhusanchar_point, 'wide' => true],
                ['label' => 'Received', 'value' => $farmerHelpCard->created_at?->format('d M Y, h:i A')],
            ],
        ]);
    }

    /**
     * Show the form for creating a farmer help card application.
     */
    public function create(): View
    {
        return view('admin.pages.enquiries.farmer-help-cards.form', [
            'title' => 'Add farmer help card',
            'subtitle' => 'Record a farmer help card application',
            'action' => route('admin.farmer-help-cards.store'),
            'record' => null,
            'submitLabel' => 'Save application',
        ]);
    }

    /**
     * Store a newly created farmer help card application.
     */
    public function store(FarmerHelpCardRequest $request): RedirectResponse
    {
        FarmerHelpCard::query()->create($request->safe()->only([
            'name',
            'email',
            'mobile',
            'state',
            'district',
            'block',
            'village',
            'preferred_bhusanchar_point',
        ]));

        return redirect()->route('admin.farmer-help-cards.index')->with('status', 'farmer-help-card-created');
    }

    /**
     * Show the form for editing a farmer help card application.
     */
    public function edit(FarmerHelpCard $farmerHelpCard): View
    {
        return view('admin.pages.enquiries.farmer-help-cards.form', [
            'title' => 'Edit farmer help card',
            'subtitle' => 'Update this farmer help card application',
            'action' => route('admin.farmer-help-cards.update', $farmerHelpCard),
            'record' => $farmerHelpCard,
            'submitLabel' => 'Update application',
        ]);
    }

    /**
     * Update the specified farmer help card application.
     */
    public function update(FarmerHelpCardRequest $request, FarmerHelpCard $farmerHelpCard): RedirectResponse
    {
        $farmerHelpCard->update($request->safe()->only([
            'name',
            'email',
            'mobile',
            'state',
            'district',
            'block',
            'village',
            'preferred_bhusanchar_point',
        ]));

        return redirect()->route('admin.farmer-help-cards.index')->with('status', 'farmer-help-card-updated');
    }

    /**
     * Update the status and optional admin message.
     */
    public function updateStatus(UpdateEnquiryStatusRequest $request, FarmerHelpCard $farmerHelpCard, UpdateEnquiryStatus $followUp): RedirectResponse
    {
        $result = $followUp->handle(
            $farmerHelpCard,
            $request->integer('status'),
            $request->adminMessage(),
            $request->boolean('send_email'),
            $farmerHelpCard->name,
            'your farmer help card application',
        );

        return redirect()
            ->route('admin.farmer-help-cards.show', $farmerHelpCard)
            ->with('status', 'enquiry-status-'.$result);
    }

    /**
     * Remove the specified farmer help card application.
     */
    public function destroy(FarmerHelpCard $farmerHelpCard): RedirectResponse
    {
        $farmerHelpCard->delete();

        return redirect()->route('admin.farmer-help-cards.index')->with('status', 'farmer-help-card-deleted');
    }
}
