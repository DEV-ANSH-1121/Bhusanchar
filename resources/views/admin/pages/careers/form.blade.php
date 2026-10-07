@extends('admin.layout.main')

@php
    $inputClass = 'rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
    $applicationDate = old('last_application_date', isset($record) ? $record->last_application_date->toDateString() : '');
@endphp

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $subtitle }}</p>

        <form method="POST" action="{{ $action }}" class="mt-6 flex flex-col gap-4">
            @csrf
            @isset($record)
                @method('PUT')
            @endisset

            @include('admin.pages.enquiries._field', ['name' => 'job_title', 'label' => 'Job title', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'job_description', 'label' => 'Job description', 'type' => 'textarea', 'required' => true, 'record' => $record])
            @include('admin.pages.careers._bullets', ['name' => 'eligible_criteria', 'label' => 'Eligible criteria', 'points' => $record?->eligible_criteria ?? ['']])
            @include('admin.pages.careers._bullets', ['name' => 'key_responsibilities', 'label' => 'Key responsibilities', 'points' => $record?->key_responsibilities ?? ['']])
            @include('admin.pages.enquiries._field', ['name' => 'salary', 'label' => 'Salary', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'location', 'label' => 'Location', 'required' => true, 'record' => $record])

            <div class="flex flex-col gap-1.5">
                <label for="last_application_date" class="text-sm font-medium text-slate-700 dark:text-slate-200">Last application date</label>
                <input id="last_application_date" type="date" name="last_application_date" value="{{ $applicationDate }}" required class="{{ $inputClass }}">
                @error('last_application_date')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $submitLabel }}</button>
                <a href="{{ route('admin.careers.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
