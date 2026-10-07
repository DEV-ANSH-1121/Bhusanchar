@extends('admin.layout.main')

@section('title', 'Stock Point')
@section('page-title', 'Stock Point')
@section('page-subtitle', 'Applications to become a BhuSanchar stock point')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Stock Point</h1>
            <a href="{{ route('admin.stock-point-applications.create') }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Add application</a>
        </div>

        @if (session('status') === 'stock-point-application-created')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Stock point application created.</p>
        @elseif (session('status') === 'stock-point-application-updated')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Stock point application updated.</p>
        @elseif (session('status') === 'stock-point-application-deleted')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Stock point application deleted.</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Applicant</th>
                            <th class="px-4 py-3">Business</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Received</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($applications as $application)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $application->applicant_name }}</p>
                                    <p class="text-slate-500 dark:text-slate-400">{{ $application->mobile }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $application->business_name }}</td>
                                <td class="px-4 py-3">@include('admin.pages.enquiries._status-badge', ['record' => $application])</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $application->created_at?->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.stock-point-applications.show', $application) }}" class="text-sm font-medium text-brand hover:underline">View</a>
                                        <form method="POST" action="{{ route('admin.stock-point-applications.destroy', $application) }}" onsubmit="return confirm('Delete this stock point application?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No stock point applications have been received yet.</td>
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
