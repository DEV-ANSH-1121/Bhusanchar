<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockPointApplicationRequest;
use App\Models\StockPointApplication;
use Illuminate\Http\RedirectResponse;

class StockPointApplicationController extends Controller
{
    /**
     * Store a stock point application from the partner form.
     */
    public function store(StoreStockPointApplicationRequest $request): RedirectResponse
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

        return back()->with('status', 'stock-point-submitted');
    }
}
