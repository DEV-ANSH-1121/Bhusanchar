@extends('admin.layout.guest')

@section('title', 'Admin login')

@section('content')
    <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-8 flex flex-col items-center gap-3 text-center">
            <img src="{{ asset('frontend/media/logo-cropped.png') }}" alt="BhuSanchar" class="h-14 w-14 rounded-xl bg-slate-50 object-contain p-1 dark:bg-slate-800">
            <div>
                <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Control Panel</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sign in to manage BhuSanchar.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-950/40 dark:text-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="flex flex-col gap-4">
            @csrf

            <div class="flex flex-col gap-1.5">
                <label for="email" class="text-sm font-medium text-slate-700 dark:text-slate-200">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="password" class="text-sm font-medium text-slate-700 dark:text-slate-200">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none ring-brand focus:ring-2 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand focus:ring-brand">
                Remember me
            </label>

            <button type="submit" class="mt-2 rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-light">
                Sign in
            </button>
        </form>
    </div>
@endsection
