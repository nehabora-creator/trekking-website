<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin') | {{ setting('site_name', 'Himalaya Trails') }}</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/tailwind-config.js') }}"></script>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="font-body text-base bg-slate-100 text-slate-800">
@php
    $menu = [
        ['admin.dashboard', 'Dashboard', 'admin.dashboard'],
        ['admin.treks.index', 'Treks', 'admin.treks.*'],
        ['admin.regions.index', 'Regions', 'admin.regions.*'],
        ['admin.slides.index', 'Home banner', 'admin.slides.*'],
        ['admin.reviews.index', 'Reviews', 'admin.reviews.*'],
        ['admin.posts.index', 'Updates and articles', 'admin.posts.*'],
        ['admin.faq-categories.index', 'FAQ tabs', 'admin.faq-categories.*'],
        ['admin.faqs.index', 'FAQ questions', 'admin.faqs.*'],
        ['admin.stats.index', 'Numbers', 'admin.stats.*'],
        ['admin.features.index', 'Why us points', 'admin.features.*'],
        ['admin.enquiries.index', 'Enquiries', 'admin.enquiries.*'],
        ['admin.users.index', 'Users', 'admin.users.*'],
        ['admin.settings.edit', 'Site settings', 'admin.settings.*'],
    ];
@endphp
@include('partials.header')
<div class="lg:flex">
 <aside class="lg:w-64 bg-slate-900 text-slate-200 lg:shrink-0">
  <div class="px-5 py-4 flex items-center justify-between lg:block">
   <a href="{{ route('admin.dashboard') }}" class="font-display font-extrabold text-xl text-white">{{ setting('site_name', 'Himalaya Trails') }}</a>
   <p class="hidden lg:block text-xs text-slate-400 mt-1">Admin panel</p>
  </div>
  <nav class="flex lg:block gap-1 overflow-x-auto noscroll px-3 pb-3 lg:pb-6 text-sm font-semibold">
   @foreach($menu as $m)
    <a href="{{ route($m[0]) }}" class="shrink-0 block rounded-lg px-3 py-2 {{ request()->routeIs($m[2]) ? 'bg-flag text-white' : 'hover:bg-slate-800' }}">{{ $m[1] }}</a>
   @endforeach
   <a href="{{ route('home') }}" target="_blank" class="shrink-0 block rounded-lg px-3 py-2 hover:bg-slate-800 text-slate-400">View website &#8599;</a>
   <form method="POST" action="{{ route('logout') }}" class="shrink-0">@csrf<button type="submit" class="block w-full text-left rounded-lg px-3 py-2 hover:bg-slate-800 text-slate-400">Logout</button></form>
  </nav>
 </aside>
 <main class="flex-1 min-w-0 p-4 md:p-8">
  @if(session('success'))<p class="mb-5 rounded-xl bg-emerald-50 text-emerald-700 font-semibold px-4 py-3">{{ session('success') }}</p>@endif
  @if($errors->any())
   <div class="mb-5 rounded-xl bg-red-50 text-red-700 px-4 py-3"><b>Please fix these:</b><ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif
  @yield('content')
 </main>
</div>
@include('partials.footer')
<script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
