@extends('admin.layout.main')

@section('title', 'Add product')
@section('page-title', 'Add product')
@section('page-subtitle', 'Create a catalog item')

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Add product</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Upload a main image and assign categories, crops, and packaging.</p>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="mt-6 flex flex-col gap-6">
            @csrf
            @include('admin.pages.products._form')
            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Save product</button>
                <a href="{{ route('admin.products.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
