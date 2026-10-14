<!DOCTYPE html>
<html
    lang="{{ $locale ?? 'en' }}"
    dir="{{ ($locale ?? 'en') === 'ar' ? 'rtl' : 'ltr' }}"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'WebLabStudios — Digital Experiences')</title>
    <meta name="description" content="@yield('meta_description', 'WebLabStudios creates digital experiences, websites, and brands.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/public/site.css'])

    @stack('styles')
</head>
<body class="public-site">

    @include('public.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('public.partials.footer')

    @stack('scripts')
</body>
</html>
