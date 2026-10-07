@php
    $selectedCategoryIds = array_map('intval', old('category_ids', isset($product) ? $product->categories->modelKeys() : []));
    $selectedCropIds = array_map('intval', old('crop_ids', isset($product) ? $product->crops->modelKeys() : []));
    $selectedPackagingIds = array_map('intval', old('packaging_ids', isset($product) ? $product->packagings->modelKeys() : []));
    $inputClass = 'rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
@endphp

<div class="flex flex-col gap-4">
    <div class="flex flex-col gap-1.5">
        <label for="name" class="text-sm font-medium text-slate-700 dark:text-slate-200">Product name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="{{ $inputClass }}">
        @error('name')
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label for="description" class="text-sm font-medium text-slate-700 dark:text-slate-200">Description</label>
        <textarea id="description" name="description" rows="4" required class="{{ $inputClass }}">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label for="price" class="text-sm font-medium text-slate-700 dark:text-slate-200">Price (INR)</label>
        <input id="price" type="number" name="price" min="0" step="0.01" value="{{ old('price', $product->price ?? '') }}" required class="{{ $inputClass }}">
        @error('price')
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label for="image" class="text-sm font-medium text-slate-700 dark:text-slate-200">Main image</label>
        @isset($product)
            <img src="{{ route('admin.products.image', $product) }}" alt="{{ $product->name }}" class="h-24 w-24 rounded-lg object-cover">
            <p class="text-xs text-slate-500 dark:text-slate-400">Leave empty to keep the current image.</p>
        @endisset
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" @required(! isset($product)) class="text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-brand file:px-3 file:py-2 file:text-sm file:font-medium file:text-white dark:text-slate-200">
        @error('image')
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    @include('admin.pages.products._multiselect', [
        'label' => 'Categories',
        'name' => 'category_ids',
        'options' => $categories,
        'selectedIds' => $selectedCategoryIds,
        'placeholder' => 'Select categories',
        'emptyMessage' => 'No categories are available. Add categories first.',
        'errorKey' => 'category_ids',
    ])

    @include('admin.pages.products._multiselect', [
        'label' => 'Suitable crops',
        'name' => 'crop_ids',
        'options' => $crops,
        'selectedIds' => $selectedCropIds,
        'placeholder' => 'Select crops',
        'emptyMessage' => 'No crops are available. Add crops first.',
        'errorKey' => 'crop_ids',
    ])

    @include('admin.pages.products._multiselect', [
        'label' => 'Packaging',
        'name' => 'packaging_ids',
        'options' => $packagings,
        'selectedIds' => $selectedPackagingIds,
        'placeholder' => 'Select packaging',
        'emptyMessage' => 'No packaging options are available. Add packaging first.',
        'errorKey' => 'packaging_ids',
    ])
</div>
