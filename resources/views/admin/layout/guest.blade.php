<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layout.head')
    </head>
    <body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
        <div class="flex min-h-screen items-center justify-center px-4 py-10">
            @yield('content')
        </div>

        @include('admin.layout.script')
    </body>
</html>
