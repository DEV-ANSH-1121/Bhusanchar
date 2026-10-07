<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmerHelpCardRequest;
use App\Models\FarmerHelpCard;
use Illuminate\Http\RedirectResponse;

class FarmerHelpCardController extends Controller
{
    /**
     * Store a farmer help card application from the public form.
     */
    public function store(StoreFarmerHelpCardRequest $request): RedirectResponse
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

        return back()->with('status', 'farmer-help-card-submitted');
    }
}
