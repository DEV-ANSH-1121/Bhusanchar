<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Control Panel') — {{ config('app.name') }}</title>

<link rel="icon" href="{{ asset('frontend/media/logo-cropped.png') }}">

<script>
    (function () {
        const theme = localStorage.getItem('admin-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (theme === 'dark' || (!theme && prefersDark)) {
            document.documentElement.classList.add('dark');
        }
    })();
</script>

@vite('resources/css/admin.css')
