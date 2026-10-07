@extends('admin.layout.main')

@php
    $inputClass = 'rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
@endphp

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $subtitle }}</p>

        <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="mt-6 grid gap-4 sm:grid-cols-2">
            @csrf
            @isset($record)
                @method('PUT')
            @endisset

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label for="career_id" class="text-sm font-medium text-slate-700 dark:text-slate-200">Job opening</label>
                <select id="career_id" name="career_id" required class="{{ $inputClass }}">
                    <option value="">Select a job</option>
                    @foreach ($careers as $career)
                        <option value="{{ $career->id }}" @selected((string) old('career_id', $record->career_id ?? '') === (string) $career->id)>{{ $career->job_title }}</option>
                    @endforeach
                </select>
                @error('career_id')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                @if ($careers->isEmpty())
                    <p class="text-sm text-slate-500 dark:text-slate-400">Add a job opening before recording an application.</p>
                @endif
            </div>

            @include('admin.pages.enquiries._field', ['name' => 'name', 'label' => 'Name', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'mobile', 'label' => 'Mobile', 'type' => 'tel', 'required' => true, 'record' => $record])

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label for="resume" class="text-sm font-medium text-slate-700 dark:text-slate-200">Resume</label>
                @isset($record)
                    <a href="{{ route('admin.career-applications.resume', $record) }}" class="text-sm font-medium text-brand hover:underline">Download current resume</a>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Leave empty to keep the current file. PDF, DOC, or DOCX up to 5 MB.</p>
                @else
                    <p class="text-xs text-slate-500 dark:text-slate-400">PDF, DOC, or DOCX up to 5 MB.</p>
                @endisset
                <input id="resume" type="file" name="resume" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" @required(! isset($record)) class="text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-brand file:px-3 file:py-2 file:text-sm file:font-medium file:text-white dark:text-slate-200">
                @error('resume')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 sm:col-span-2">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $submitLabel }}</button>
                <a href="{{ route('admin.career-applications.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
