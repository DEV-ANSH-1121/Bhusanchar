@extends('admin.layout.main')

@section('title', 'Farmer Help Card')
@section('page-title', 'Farmer Help Card')
@section('page-subtitle', 'Applications for the farmer help card')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Farmer Help Card</h1>
            <a href="{{ route('admin.farmer-help-cards.create') }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Add application</a>
        </div>

        @if (session('status') === 'farmer-help-card-created')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Farmer help card application created.</p>
        @elseif (session('status') === 'farmer-help-card-updated')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Farmer help card application updated.</p>
        @elseif (session('status') === 'farmer-help-card-deleted')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Farmer help card application deleted.</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">District</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Received</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($applications as $application)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $application->name }}</p>
                                    <p class="text-slate-500 dark:text-slate-400">{{ $application->mobile }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $application->district }}</td>
                                <td class="px-4 py-3">@include('admin.pages.enquiries._status-badge', ['record' => $application])</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $application->created_at?->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.farmer-help-cards.show', $application) }}" class="text-sm font-medium text-brand hover:underline">View</a>
                                        <form method="POST" action="{{ route('admin.farmer-help-cards.destroy', $application) }}" onsubmit="return confirm('Delete this farmer help card application?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No farmer help card applications have been received yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($applications->hasPages())
            <div>{{ $applications->links() }}</div>
        @endif
    </div>
@endsection
