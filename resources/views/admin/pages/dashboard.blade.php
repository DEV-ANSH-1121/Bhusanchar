@extends('admin.layout.main')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of the control panel')

@section('content')
    <div class="flex flex-col gap-6">
        <section class="rounded-2xl bg-brand px-6 py-8 text-white">
            <p class="text-sm text-white/80">Welcome back</p>
            <h1 class="mt-1 text-2xl font-semibold">{{ auth('admin')->user()->name }}</h1>
            <p class="mt-2 max-w-2xl text-sm text-white/80">Use this panel to manage your profile, password, and upcoming BhuSanchar operations.</p>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-brand dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Products</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Create and manage catalog items.</p>
            </a>
            <a href="{{ route('admin.contact-enquiries.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-brand dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Enquiries</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Review contact, farmer, stock point, and career submissions.</p>
            </a>
            <a href="{{ route('admin.careers.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-brand dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Careers</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Publish job openings and application deadlines.</p>
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-brand dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Profile</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Update your name and email address.</p>
            </a>
            <a href="{{ route('admin.profile.edit') }}#password" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-brand dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Password</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Change your sign-in password.</p>
            </a>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Notifications</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">You have no unread alerts right now.</p>
            </div>
        </section>
    </div>
@endsection
