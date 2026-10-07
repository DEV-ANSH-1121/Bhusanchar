<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CatalogTermRequest;
use App\Models\Packaging;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackagingController extends Controller
{
    /**
     * Display a listing of packaging options.
     */
    public function index(): View
    {
        return view('admin.pages.catalog.index', [
            'title' => 'Packaging',
            'subtitle' => 'Manage product packaging sizes',
            'createLabel' => 'Add packaging',
            'emptyMessage' => 'No packaging options have been added yet.',
            'records' => Packaging::query()->withCount('products')->orderBy('name')->orderBy('id')->paginate(15),
            'createRoute' => 'admin.packagings.create',
            'editRoute' => 'admin.packagings.edit',
            'destroyRoute' => 'admin.packagings.destroy',
            'createdStatus' => 'packaging-created',
            'updatedStatus' => 'packaging-updated',
            'deletedStatus' => 'packaging-deleted',
            'createdMessage' => 'Packaging created.',
            'updatedMessage' => 'Packaging updated.',
            'deletedMessage' => 'Packaging deleted.',
        ]);
    }

    /**
     * Show the form for creating a packaging option.
     */
    public function create(): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Add packaging',
            'subtitle' => 'Create a packaging size',
            'action' => route('admin.packagings.store'),
            'record' => null,
            'submitLabel' => 'Save packaging',
            'indexRoute' => 'admin.packagings.index',
        ]);
    }

    /**
     * Store a newly created packaging option.
     */
    public function store(CatalogTermRequest $request): RedirectResponse
    {
        Packaging::query()->create($request->safe()->only(['name']));

        return redirect()->route('admin.packagings.index')->with('status', 'packaging-created');
    }

    /**
     * Show the form for editing a packaging option.
     */
    public function edit(Packaging $packaging): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Edit packaging',
            'subtitle' => 'Update this packaging size',
            'action' => route('admin.packagings.update', $packaging),
            'record' => $packaging,
            'submitLabel' => 'Update packaging',
            'indexRoute' => 'admin.packagings.index',
        ]);
    }

    /**
     * Update the specified packaging option.
     */
    public function update(CatalogTermRequest $request, Packaging $packaging): RedirectResponse
    {
        $packaging->update($request->safe()->only(['name']));

        return redirect()->route('admin.packagings.index')->with('status', 'packaging-updated');
    }

    /**
     * Remove the specified packaging option.
     */
    public function destroy(Packaging $packaging): RedirectResponse
    {
        $packaging->delete();

        return redirect()->route('admin.packagings.index')->with('status', 'packaging-deleted');
    }
}
