<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CatalogTermRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        return view('admin.pages.catalog.index', [
            'title' => 'Categories',
            'subtitle' => 'Manage product categories',
            'createLabel' => 'Add category',
            'emptyMessage' => 'No categories have been added yet.',
            'records' => Category::query()->withCount('products')->orderBy('name')->orderBy('id')->paginate(15),
            'createRoute' => 'admin.categories.create',
            'editRoute' => 'admin.categories.edit',
            'destroyRoute' => 'admin.categories.destroy',
            'createdStatus' => 'category-created',
            'updatedStatus' => 'category-updated',
            'deletedStatus' => 'category-deleted',
            'createdMessage' => 'Category created.',
            'updatedMessage' => 'Category updated.',
            'deletedMessage' => 'Category deleted.',
        ]);
    }

    /**
     * Show the form for creating a category.
     */
    public function create(): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Add category',
            'subtitle' => 'Create a product category',
            'action' => route('admin.categories.store'),
            'record' => null,
            'submitLabel' => 'Save category',
            'indexRoute' => 'admin.categories.index',
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(CatalogTermRequest $request): RedirectResponse
    {
        Category::query()->create($request->safe()->only(['name']));

        return redirect()->route('admin.categories.index')->with('status', 'category-created');
    }

    /**
     * Show the form for editing a category.
     */
    public function edit(Category $category): View
    {
        return view('admin.pages.catalog.form', [
            'title' => 'Edit category',
            'subtitle' => 'Update this product category',
            'action' => route('admin.categories.update', $category),
            'record' => $category,
            'submitLabel' => 'Update category',
            'indexRoute' => 'admin.categories.index',
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(CatalogTermRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->safe()->only(['name']));

        return redirect()->route('admin.categories.index')->with('status', 'category-updated');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'category-deleted');
    }
}
