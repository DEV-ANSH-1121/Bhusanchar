@extends('admin.layout.main')

@section('title', 'Profile')
@section('page-title', 'Profile')
@section('page-subtitle', 'Update your account details')

@section('content')
    <div class="mx-auto flex max-w-3xl flex-col gap-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Profile information</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update your name and email address.</p>

            @if (session('status') === 'profile-updated')
                <p class="mt-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Profile updated.</p>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}" class="mt-6 flex flex-col gap-4">
                @csrf
                @method('PATCH')

                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-sm font-medium text-slate-700 dark:text-slate-200">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $admin->name) }}" required autocomplete="name" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('name')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-sm font-medium text-slate-700 dark:text-slate-200">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $admin->email) }}" required autocomplete="username" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('email')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="self-start rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">
                    Save profile
                </button>
            </form>
        </section>

        <section id="password" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Change password</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Use a long password that you do not use elsewhere.</p>

            @if (session('status') === 'password-updated')
                <p class="mt-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Password updated.</p>
            @endif

            <form method="POST" action="{{ route('admin.password.update') }}" class="mt-6 flex flex-col gap-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-1.5">
                    <label for="current_password" class="text-sm font-medium text-slate-700 dark:text-slate-200">Current password</label>
                    <input id="current_password" type="password" name="current_password" required autocomplete="current-password" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('current_password')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-sm font-medium text-slate-700 dark:text-slate-200">New password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('password')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password_confirmation" class="text-sm font-medium text-slate-700 dark:text-slate-200">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                </div>

                <button type="submit" class="self-start rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">
                    Update password
                </button>
            </form>
        </section>
    </div>
@endsection
