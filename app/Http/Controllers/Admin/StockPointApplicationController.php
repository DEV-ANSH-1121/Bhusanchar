<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\UpdateEnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockPointApplicationRequest;
use App\Http\Requests\Admin\UpdateEnquiryStatusRequest;
use App\Models\StockPointApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockPointApplicationController extends Controller
{
    /**
     * Display a listing of stock point applications.
     */
    public function index(): View
    {
        return view('admin.pages.enquiries.stock-points.index', [
            'applications' => StockPointApplication::query()->latest()->orderByDesc('id')->paginate(15),
        ]);
    }

    /**
     * Display a stock point application.
     */
    public function show(StockPointApplication $stockPointApplication): View
    {
        return view('admin.pages.enquiries.show', [
            'title' => 'Stock point application',
            'subtitle' => 'Review this application and update its status',
            'eyebrow' => 'Stock Point',
            'heading' => $stockPointApplication->applicant_name,
            'record' => $stockPointApplication,
            'statusAction' => route('admin.stock-point-applications.status', $stockPointApplication),
            'indexRoute' => 'admin.stock-point-applications.index',
            'editRoute' => route('admin.stock-point-applications.edit', $stockPointApplication),
            'rows' => [
                ['label' => 'Business name', 'value' => $stockPointApplication->business_name],
                ['label' => 'Email', 'value' => $stockPointApplication->email],
                ['label' => 'Mobile', 'value' => $stockPointApplication->mobile],
                ['label' => 'State', 'value' => $stockPointApplication->state],
                ['label' => 'District', 'value' => $stockPointApplication->district],
                ['label' => 'Block', 'value' => $stockPointApplication->block],
                ['label' => 'Panchayat', 'value' => $stockPointApplication->panchayat],
                ['label' => 'Received', 'value' => $stockPointApplication->created_at?->format('d M Y, h:i A')],
                ['label' => 'Business address', 'value' => $stockPointApplication->business_address, 'wide' => true],
            ],
        ]);
    }

    /**
     * Show the form for creating a stock point application.
     */
    public function create(): View
    {
        return view('admin.pages.enquiries.stock-points.form', [
            'title' => 'Add stock point application',
            'subtitle' => 'Record a stock point partner application',
            'action' => route('admin.stock-point-applications.store'),
            'record' => null,
            'submitLabel' => 'Save application',
        ]);
    }

    /**
     * Store a newly created stock point application.
     */
    public function store(StockPointApplicationRequest $request): RedirectResponse
    {
        StockPointApplication::query()->create($request->safe()->only([
            'applicant_name',
            'business_name',
            'email',
            'mobile',
            'state',
            'district',
            'block',
            'panchayat',
            'business_address',
        ]));

        return redirect()->route('admin.stock-point-applications.index')->with('status', 'stock-point-application-created');
    }

    /**
     * Show the form for editing a stock point application.
     */
    public function edit(StockPointApplication $stockPointApplication): View
    {
        return view('admin.pages.enquiries.stock-points.form', [
            'title' => 'Edit stock point application',
            'subtitle' => 'Update this stock point partner application',
            'action' => route('admin.stock-point-applications.update', $stockPointApplication),
            'record' => $stockPointApplication,
            'submitLabel' => 'Update application',
        ]);
    }

    /**
     * Update the specified stock point application.
     */
    public function update(StockPointApplicationRequest $request, StockPointApplication $stockPointApplication): RedirectResponse
    {
        $stockPointApplication->update($request->safe()->only([
            'applicant_name',
            'business_name',
            'email',
            'mobile',
            'state',
            'district',
            'block',
            'panchayat',
            'business_address',
        ]));

        return redirect()->route('admin.stock-point-applications.index')->with('status', 'stock-point-application-updated');
    }

    /**
     * Update the status and optional admin message.
     */
    public function updateStatus(UpdateEnquiryStatusRequest $request, StockPointApplication $stockPointApplication, UpdateEnquiryStatus $followUp): RedirectResponse
    {
        $result = $followUp->handle(
            $stockPointApplication,
            $request->integer('status'),
            $request->adminMessage(),
            $request->boolean('send_email'),
            $stockPointApplication->applicant_name,
            'your stock point application',
        );

        return redirect()
            ->route('admin.stock-point-applications.show', $stockPointApplication)
            ->with('status', 'enquiry-status-'.$result);
    }

    /**
     * Remove the specified stock point application.
     */
    public function destroy(StockPointApplication $stockPointApplication): RedirectResponse
    {
        $stockPointApplication->delete();

        return redirect()->route('admin.stock-point-applications.index')->with('status', 'stock-point-application-deleted');
    }
}
