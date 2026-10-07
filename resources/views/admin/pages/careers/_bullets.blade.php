@php
    $inputClass = 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
    $points = old($name, $points ?? ['']);

    if (! is_array($points) || $points === []) {
        $points = [''];
    }
@endphp

<div class="flex flex-col gap-1.5" data-bullet-list>
    <div class="flex items-center justify-between gap-3">
        <span class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $label }}</span>
        <button type="button" data-bullet-add class="text-sm font-medium text-brand hover:underline">Add point</button>
    </div>
    <div data-bullet-rows class="flex flex-col gap-2">
        @foreach ($points as $point)
            <div data-bullet-row class="flex gap-2">
                <input type="text" name="{{ $name }}[]" value="{{ $point }}" class="{{ $inputClass }} min-w-0 flex-1">
                <button type="button" data-bullet-remove class="shrink-0 rounded-lg px-3 text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/40">Remove</button>
            </div>
        @endforeach
    </div>
    @error($name)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @foreach ($errors->get($name.'.*') as $message)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @endforeach
    <template data-bullet-template>
        <div data-bullet-row class="flex gap-2">
            <input type="text" name="{{ $name }}[]" value="" class="{{ $inputClass }} min-w-0 flex-1">
            <button type="button" data-bullet-remove class="shrink-0 rounded-lg px-3 text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/40">Remove</button>
        </div>
    </template>
</div>
