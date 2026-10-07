@extends('admin.layout.main')

@php
    $inputClass = 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white';
@endphp

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="flex flex-col gap-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route($indexRoute) }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white">Back to list</a>
            <a href="{{ $editRoute }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Edit details</a>
        </div>

        @if (session('status') === 'enquiry-status-saved')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Status updated.</p>
        @elseif (session('status') === 'enquiry-status-emailed')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Status updated and the message was emailed.</p>
        @elseif (session('status') === 'enquiry-status-email-failed')
            <p class="rounded-lg bg-amber-50 px-4 py-3 text-sm text-amber-800 dark:bg-amber-950/40 dark:text-amber-200">Status was saved, but the email could not be sent.</p>
        @endif

        <div class="grid items-start gap-6 lg:grid-cols-3">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2 dark:border-slate-800 dark:bg-slate-900">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold tracking-wide text-brand uppercase">{{ $eyebrow }}</p>
                        <h1 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">{{ $heading }}</h1>
                    </div>
                    @include('admin.pages.enquiries._status-badge', ['record' => $record])
                </div>

                <dl class="mt-6 grid gap-5 sm:grid-cols-2">
                    @foreach ($rows as $row)
                        <div @class(['sm:col-span-2' => $row['wide'] ?? false])>
                            <dt class="text-xs font-semibold tracking-wide text-slate-500 uppercase dark:text-slate-400">{{ $row['label'] }}</dt>
                            <dd class="mt-1 whitespace-pre-wrap text-sm text-slate-900 dark:text-slate-100">{{ filled($row['value']) ? $row['value'] : '—' }}</dd>
                        </div>
                    @endforeach
                </dl>

                @isset($resumeUrl)
                    <a href="{{ $resumeUrl }}" class="mt-6 inline-flex rounded-lg bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-800 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">Download resume</a>
                @endisset
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Follow up</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update the status and leave a message for this enquiry.</p>

                <form method="POST" action="{{ $statusAction }}" class="mt-5 flex flex-col gap-4">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-col gap-1.5">
                        <label for="status" class="text-sm font-medium text-slate-700 dark:text-slate-200">Status</label>
                        <select id="status" name="status" required class="{{ $inputClass }}">
                            @foreach ($record::STATUSES as $value => $label)
                                <option value="{{ $value }}" @selected((string) old('status', $record->status) === (string) $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="admin_message" class="text-sm font-medium text-slate-700 dark:text-slate-200">Message</label>
                        <textarea id="admin_message" name="admin_message" rows="6" class="{{ $inputClass }}">{{ old('admin_message', $record->admin_message) }}</textarea>
                        @error('admin_message')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-start gap-2 text-sm text-slate-700 dark:text-slate-200">
                        <input type="checkbox" name="send_email" value="1" @checked(old('send_email')) class="mt-0.5 rounded border-slate-300 text-brand focus:ring-brand">
                        <span>Email this message to the applicant</span>
                    </label>

                    <button type="submit" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Save follow-up</button>
                </form>
            </section>
        </div>
    </div>
@endsection
