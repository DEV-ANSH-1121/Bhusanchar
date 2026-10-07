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
            @include('admin.pages.enquiries._field', ['name' => 'product_interested', 'label' => 'Product interested', 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'state', 'label' => 'State', 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'district', 'label' => 'District', 'record' => $record])
            @include('admin.pages.enquiries._field', ['name' => 'block', 'label' => 'Block', 'record' => $record])

            <div class="flex flex-col gap-1.5">
                <label for="inquiry_type" class="text-sm font-medium text-slate-700 dark:text-slate-200">Inquiry type</label>
                <select id="inquiry_type" name="inquiry_type" required class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @foreach ($inquiryTypes as $inquiryType)
                        <option value="{{ $inquiryType->value }}" @selected((string) old('inquiry_type', $record?->inquiry_type?->value) === (string) $inquiryType->value)>{{ $inquiryType->label() }}</option>
                    @endforeach
                </select>
                @error('inquiry_type')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2">
                @include('admin.pages.enquiries._field', ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true, 'record' => $record])
            </div>

            <div class="flex gap-3 sm:col-span-2">
                <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $submitLabel }}</button>
                <a href="{{ route('admin.contact-enquiries.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection
