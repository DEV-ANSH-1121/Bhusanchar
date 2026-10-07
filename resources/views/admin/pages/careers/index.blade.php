@extends('admin.layout.main')

@section('title', 'Careers')
@section('page-title', 'Careers')
@section('page-subtitle', 'Job openings shown on the public careers page')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Careers</h1>
            <a href="{{ route('admin.careers.create') }}" class="rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">Add job</a>
        </div>

        @if (session('status') === 'career-created')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Job opening created.</p>
        @elseif (session('status') === 'career-updated')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Job opening updated.</p>
        @elseif (session('status') === 'career-deleted')
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Job opening deleted.</p>
        @elseif (session('status') === 'career-has-applications')
            <p class="rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-950/40 dark:text-red-300">Delete the applications for this job before deleting the job.</p>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:bg-slate-800/60 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Job title</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">Salary</th>
                            <th class="px-4 py-3">Last application date</th>
                            <th class="px-4 py-3">Applications</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($careers as $career)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $career->job_title }}</p>
                                    <p class="max-w-xs truncate text-slate-500 dark:text-slate-400">{{ $career->job_description }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $career->location }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $career->salary }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $career->last_application_date->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $career->applications_count }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.careers.edit', $career) }}" class="text-sm font-medium text-brand hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" onsubmit="return confirm('Delete this job opening?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No job openings have been added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($careers->hasPages())
            <div>{{ $careers->links() }}</div>
        @endif
    </div>
@endsection
