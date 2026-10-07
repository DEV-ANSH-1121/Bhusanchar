@extends('admin.layout.main')

@section('title', 'Products')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage the agricultural product catalog')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Add product</a>
        </div>

        @if (session('status') === 'product-created')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Product created.</p>
        @elseif (session('status') === 'product-updated')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Product updated.</p>
        @elseif (session('status') === 'product-deleted')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Product deleted.</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Categories</th>
                            <th class="px-4 py-3">Crops</th>
                            <th class="px-4 py-3">Packaging</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ route('admin.products.image', $product) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover">
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">{{ $product->name }}</p>
                                            <p class="max-w-xs truncate text-slate-500 dark:text-slate-400">{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $product->categories->pluck('name')->join(', ') }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $product->crops->pluck('name')->join(', ') }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $product->packagings->pluck('name')->join(', ') }}</td>
                                <td class="px-4 py-3 font-medium text-slate-900 dark:text-white">{{ Number::currency((float) $product->price, in: 'INR', locale: 'en_IN') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-medium text-brand hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No products have been added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($products->hasPages())
            <div>
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
