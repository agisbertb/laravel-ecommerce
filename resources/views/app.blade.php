<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title inertia>{{ $page['props']['siteSettings']['seo_title'] ?? config('app.name', 'Laravel') }}</title>

    <!-- SEO Meta Tags -->

    <meta name="description" content="{{ $page['props']['siteSettings']['seo_description'] ?? '' }}">
    <meta name="keywords" content="{{ $page['props']['siteSettings']['seo_keywords'] ?? '' }}">
    <meta name="author" content="{{ $page['props']['siteSettings']['author'] ?? '' }}">
    <meta name="robots" content="{{ $page['props']['siteSettings']['robots'] ?? 'index, follow' }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $page['props']['siteSettings']['og_title'] ?? '' }}">
    <meta property="og:description" content="{{ $page['props']['siteSettings']['og_description'] ?? '' }}">
    <meta property="og:image" content="{{ $page['props']['siteSettings']['og_image'] ?? '' }}">
    <meta property="og:url" content="{{ $page['props']['siteSettings']['canonical_url'] ?? url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{ $page['props']['siteSettings']['twitter_card'] ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $page['props']['siteSettings']['twitter_title'] ?? '' }}">
    <meta name="twitter:description" content="{{ $page['props']['siteSettings']['twitter_description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $page['props']['siteSettings']['twitter_image'] ?? '' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $page['props']['siteSettings']['canonical_url'] ?? url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset($page['props']['siteSettings']['favicon'] ?? 'favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <!-- Cookies -->
    @include('cookie-consent::index')
</head>
<body class="font-sans antialiased bg-gray-100">
@inertia
</body>
</html>
