@php
    $selectedCount = count($selectedIds);
    $optionCount = $options->count();
    $summary = $selectedCount === 0
        ? $placeholder
        : ($optionCount > 0 && $selectedCount === $optionCount ? 'All '.$selectedCount.' selected' : $selectedCount.' selected');
@endphp

<fieldset class="flex flex-col gap-1.5">
    <legend class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $label }}</legend>
    <div data-multiselect class="relative">
        <button type="button" data-multiselect-toggle class="flex w-full items-center justify-between gap-3 rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-left text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
            <span data-multiselect-summary data-placeholder="{{ $placeholder }}">{{ $summary }}</span>
            <svg class="h-4 w-4 shrink-0 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
            </svg>
        </button>
        <div data-multiselect-panel class="absolute z-20 mt-1 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-900">
            <div class="flex items-center justify-between gap-3 border-b border-slate-200 px-3 py-2 dark:border-slate-800">
                <button type="button" data-select-all class="text-xs font-medium text-brand hover:underline">Select all</button>
                <button type="button" data-clear-group="{{ $name }}[]" class="text-xs font-medium text-slate-500 hover:underline dark:text-slate-400">Clear selection</button>
            </div>
            <div class="max-h-48 overflow-y-auto p-2">
                @forelse ($options as $option)
                    <label class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800">
                        <input type="checkbox" data-multiselect-option name="{{ $name }}[]" value="{{ $option->id }}" @checked(in_array($option->id, $selectedIds, true)) class="rounded border-slate-300 text-brand focus:ring-brand">
                        {{ $option->name }}
                    </label>
                @empty
                    <p class="px-2 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $emptyMessage }}</p>
                @endforelse
            </div>
        </div>
    </div>
    @error($errorKey)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</fieldset>
