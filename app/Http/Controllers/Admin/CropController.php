<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CatalogTermRequest;
use App\Models\Crop;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CropController extends Controller
{
    /**
     * Display a listing of crops.
     */
    public function index(): View
    {
        return view('admin.pages.catalog.index', [
            'title' => 'Crops',
            'subtitle' => 'Manage suitable crops',
            'createLabel' => 'Add crop',
            'emptyMessage' => 'No crops have been added yet.',
            'records' => Crop::query()->withCount('products')->orderBy('name')->orderBy('id')->paginate(15),
            'createRoute' => 'admin.crops.create',
            'editRoute' => 'admin.crops.edit',
            'destroyRoute' => 'admin.crops.destroy',
            'createdStatus' => 'crop-created',
            'updatedStatus' => 'crop-updated',
            'deletedStatus' => 'crop-deleted',
            'createdMessage' => 'Crop created.',
            'updatedMessage' => 'Crop updated.',
            'deletedMessage' => 'Crop deleted.',
        ]);
    }

    /**
     * Show the form for creating a crop.
     */
    public function create(): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Add crop',
            'subtitle' => 'Create a suitable crop',
            'action' => route('admin.crops.store'),
            'record' => null,
            'submitLabel' => 'Save crop',
            'indexRoute' => 'admin.crops.index',
        ]);
    }

    /**
     * Store a newly created crop.
     */
    public function store(CatalogTermRequest $request): RedirectResponse
    {
        Crop::query()->create($request->safe()->only(['name']));

        return redirect()->route('admin.crops.index')->with('status', 'crop-created');
    }

    /**
     * Show the form for editing a crop.
     */
    public function edit(Crop $crop): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Edit crop',
            'subtitle' => 'Update this suitable crop',
            'action' => route('admin.crops.update', $crop),
            'record' => $crop,
            'submitLabel' => 'Update crop',
            'indexRoute' => 'admin.crops.index',
        ]);
    }

    /**
     * Update the specified crop.
     */
    public function update(CatalogTermRequest $request, Crop $crop): RedirectResponse
    {
        $crop->update($request->safe()->only(['name']));

        return redirect()->route('admin.crops.index')->with('status', 'crop-updated');
    }

    /**
     * Remove the specified crop.
     */
    public function destroy(Crop $crop): RedirectResponse
    {
        $crop->delete();

        return redirect()->route('admin.crops.index')->with('status', 'crop-deleted');
    }
}
