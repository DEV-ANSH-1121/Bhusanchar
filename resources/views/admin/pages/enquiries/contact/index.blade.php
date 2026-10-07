@extends('admin.layout.main')

@section('title', 'Contact Us')
@section('page-title', 'Contact Us')
@section('page-subtitle', 'Messages sent from the contact form')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Contact Us</h1>
            <a href="{{ route('admin.contact-enquiries.create') }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Add enquiry</a>
        </div>

        @if (session('status') === 'contact-enquiry-created')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Contact enquiry created.</p>
        @elseif (session('status') === 'contact-enquiry-updated')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Contact enquiry updated.</p>
        @elseif (session('status') === 'contact-enquiry-deleted')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Contact enquiry deleted.</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Inquiry type</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Received</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($enquiries as $enquiry)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $enquiry->name }}</p>
                                    <p class="text-slate-500 dark:text-slate-400">{{ $enquiry->email }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $enquiry->inquiry_type->label() }}</td>
                                <td class="px-4 py-3">@include('admin.pages.enquiries._status-badge', ['record' => $enquiry])</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $enquiry->created_at?->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.contact-enquiries.show', $enquiry) }}" class="text-sm font-medium text-brand hover:underline">View</a>
                                        <form method="POST" action="{{ route('admin.contact-enquiries.destroy', $enquiry) }}" onsubmit="return confirm('Delete this contact enquiry?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No contact enquiries have been received yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($enquiries->hasPages())
            <div>{{ $enquiries->links() }}</div>
        @endif
    </div>
@endsection
