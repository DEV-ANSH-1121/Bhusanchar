@php
    $inputClass = 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
    $current = old($name, data_get($record, $name));

    if ($current instanceof \BackedEnum) {
        $current = $current->value;
    }
@endphp

<div class="flex flex-col gap-1.5">
    <label for="{{ $name }}" class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $label }}</label>
    @if (($type ?? 'text') === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows ?? 5 }}" @required($required ?? false) class="{{ $inputClass }}">{{ $current }}</textarea>
    @else
        <input id="{{ $name }}" type="{{ $type ?? 'text' }}" name="{{ $name }}" value="{{ $current }}" @required($required ?? false) class="{{ $inputClass }}">
    @endif
    @error($name)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
