<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', setting('site_name', 'Himalaya Trails'))</title>
<meta name="description" content="@yield('description', 'Guided Himalayan treks: filter by season, region and difficulty, and plan your next adventure.')">
<script>document.documentElement.classList.add('reveal-ready');</script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/tailwind-config.js') }}"></script>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stack('head')
</head>
<body class="font-body text-lg bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-100">
@include('partials.marquee')
@include('partials.header')
<main>
@yield('content')
</main>
@hasSection('hide_categories')
@else
@include('partials.categories')
@endif
@include('partials.footer')
<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
@stack('scripts')
</body>
</html>
