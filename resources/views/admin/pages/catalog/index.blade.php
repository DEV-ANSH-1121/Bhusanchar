@extends('admin.layout.main')

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
            <a href="{{ route($createRoute) }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">{{ $createLabel }}</a>
        </div>

        @if (session('status') === $createdStatus)
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">{{ $createdMessage }}</p>
        @elseif (session('status') === $updatedStatus)
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">{{ $updatedMessage }}</p>
        @elseif (session('status') === $deletedStatus)
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">{{ $deletedMessage }}</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Products</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($records as $record)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900 dark:text-white">{{ $record->name }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $record->products_count }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route($editRoute, $record) }}" class="text-sm font-medium text-brand hover:underline">Edit</a>
                                        <form method="POST" action="{{ route($destroyRoute, $record) }}" onsubmit="return confirm('Delete this record? Assigned products will keep their other values.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">{{ $emptyMessage }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($records->hasPages())
            <div>
                {{ $records->links() }}
            </div>
        @endif
    </div>
@endsection
