@extends('admin.layout.main')

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="mx-auto max-w-xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $subtitle }}</p>

        <form method="POST" action="{{ $action }}" class="mt-6 flex flex-col gap-4">
            @csrf
            @isset($record)
                @method('PUT')
            @endisset

            <div class="flex flex-col gap-1.5">
                <label for="name" class="text-sm font-medium text-slate-700 dark:text-slate-200">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $record->name ?? '') }}" required class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                @error('name')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $submitLabel }}</button>
                <a href="{{ route($indexRoute) }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
