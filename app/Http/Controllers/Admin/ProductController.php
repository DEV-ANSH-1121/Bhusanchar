<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\ManageProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::query()
            ->with(['categories', 'crops', 'packagings'])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a product.
     */
    public function create(): View
    {
        return view('admin.pages.products.create', $this->formOptions());
    }

    /**
     * Store a newly created product.
     */
    public function store(ProductRequest $request, ManageProduct $products): RedirectResponse
    {
        $image = $request->file('image');

        if (! $image instanceof UploadedFile) {
            abort(422);
        }

        $products->create(
            $request->productAttributes(),
            $image,
            $request->relationIds(),
        );

        return redirect()->route('admin.products.index')->with('status', 'product-created');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product): View
    {
        $product->load(['categories', 'crops', 'packagings']);

        return view('admin.pages.products.edit', [
            ...$this->formOptions(),
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(ProductRequest $request, Product $product, ManageProduct $products): RedirectResponse
    {
        $image = $request->file('image');

        $products->update(
            $product,
            $request->productAttributes(),
            $request->relationIds(),
            $image instanceof UploadedFile ? $image : null,
        );

        return redirect()->route('admin.products.index')->with('status', 'product-updated');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product, ManageProduct $products): RedirectResponse
    {
        $products->delete($product);

        return redirect()->route('admin.products.index')->with('status', 'product-deleted');
    }

    /**
     * Stream the product image from the configured filesystem disk.
     */
    public function image(Product $product): StreamedResponse
    {
        return $product->image();
    }

    /**
     * @return array{categories: Collection<int, Category>, crops: Collection<int, Crop>, packagings: Collection<int, Packaging>}
     */
    private function formOptions(): array
    {
        return [
            'categories' => Category::query()->orderBy('name')->orderBy('id')->get(),
            'crops' => Crop::query()->orderBy('name')->orderBy('id')->get(),
            'packagings' => Packaging::query()->orderBy('name')->orderBy('id')->get(),
        ];
    }
}
