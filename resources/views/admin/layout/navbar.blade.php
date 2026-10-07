<header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-slate-200 bg-white/90 px-4 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90 lg:px-6">
    <div class="flex items-center gap-3">
        <button type="button" data-sidebar-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 lg:hidden" aria-label="Open navigation">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>
        <div>
            <p class="text-sm font-semibold text-slate-900 dark:text-white">@yield('page-title', 'Dashboard')</p>
            <p class="hidden text-xs text-slate-500 sm:block dark:text-slate-400">@yield('page-subtitle', 'Manage BhuSanchar operations')</p>
        </div>
    </div>

    <div class="flex items-center gap-1.5">
        <div data-menu class="relative">
            <button type="button" data-menu-toggle class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="Notifications">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </button>
            <div data-menu-panel class="absolute right-0 mt-2 w-80 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-900">
                <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Notifications</p>
                </div>
                <p class="px-4 py-8 text-center text-sm text-slate-500 dark:text-slate-400">No new notifications.</p>
            </div>
        </div>

        <button type="button" data-theme-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="Toggle theme">
            <svg class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
            <svg class="hidden h-5 w-5 dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25M12 18.75V21M4.219 4.219 5.81 5.81M18.19 18.19l1.591 1.591M3 12h2.25M18.75 12H21M4.219 19.781 5.81 18.19M18.19 5.81l1.591-1.591M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
        </button>

        <div data-menu class="relative">
            <button type="button" data-menu-toggle class="inline-flex items-center gap-2 rounded-lg px-2 py-1.5 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Account menu">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand text-xs font-semibold text-white">
                    {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                </span>
                <span class="hidden text-left sm:block">
                    <span class="block text-sm font-medium text-slate-900 dark:text-white">{{ auth('admin')->user()->name }}</span>
                    <span class="block text-xs text-slate-500 dark:text-slate-400">{{ auth('admin')->user()->email }}</span>
                </span>
            </button>
            <div data-menu-panel class="absolute right-0 mt-2 w-52 overflow-hidden rounded-xl border border-slate-200 bg-white py-1 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800">Profile settings</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800">Sign out</button>
                </form>
            </div>
        </div>
    </div>
</header>
