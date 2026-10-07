@extends('admin.layout.main')

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $subtitle }}</p>

        <form method="POST" action="{{ $action }}" class="mt-6 grid gap-4 sm:grid-cols-2">
            @csrf
            @isset($record)
                @method('PUT')
            @endisset

            @include('admin.pages.enquiries._field', ['name' => 'name', 'label' => 'Name', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'mobile', 'label' => 'Mobile', 'type' => 'tel', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'state', 'label' => 'State', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'district', 'label' => 'District', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'block', 'label' => 'Block', 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'village', 'label' => 'Village', 'record' => $record])
            <div class="sm:col-span-2">
                @include('admin.pages.enquiries._field', ['name' => 'preferred_bhusanchar_point', 'label' => 'Preferred BhuSanchar point', 'record' => $record])
            </div>

            <div class="flex gap-3 sm:col-span-2">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $submitLabel }}</button>
                <a href="{{ route('admin.farmer-help-cards.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
