<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layout.head')
    </head>
    <body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
        <div class="flex min-h-screen">
            <div data-sidebar-backdrop class="fixed inset-0 z-30 bg-slate-950/50 lg:hidden"></div>

            @include('admin.layout.sidebar')

            <div class="flex min-w-0 flex-1 flex-col">
                @include('admin.layout.navbar')

                <main class="flex-1 p-4 lg:p-6">
                    @yield('content')
                </main>
            </div>
        </div>

        @include('admin.layout.script')
    </body>
</html>
