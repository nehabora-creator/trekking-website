@php
    $homeUrl = route('home');
    $menu = \App\Support\Categories::menu();
    $linkClass = 'block rounded-lg px-3 py-2.5 hover:bg-flag/10 hover:text-flag';
$itemClass = 'flex items-center justify-between gap-3 rounded-lg px-3 py-2.5 hover:text-red-600';
    $headClass = 'pb-2 mb-2 border-b border-slate-200 dark:border-slate-700 text-xs font-bold tracking-widest uppercase text-slate-500';
@endphp
<header id="site-header" class="sticky z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur text-slate-800 dark:text-white border-b border-slate-200 dark:border-slate-800" style="top:env(safe-area-inset-top,0px)">
 <div class="max-w-7xl mx-auto px-4 h-16 flex items-center gap-3 lg:gap-4">
  <a href="{{ $homeUrl }}" class="font-display font-extrabold text-xl whitespace-nowrap">{{ setting('site_name', 'Himalaya Trails') }}</a>

  {{-- Search box --}}
  <form action="{{ route('search') }}" method="GET" role="search" class="hidden md:block flex-1 max-w-xl">
   <label for="hs" class="sr-only">Search treks</label>
   <input id="hs" type="search" name="q" value="{{ request('q') }}" list="trek-names" autocomplete="off" placeholder="Search treks..." class="w-full rounded-full border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-800 px-5 py-2.5 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
  </form>

  <div class="ml-auto md:ml-0 flex items-center gap-1 lg:gap-2 text-base font-semibold">
   <button id="choose-btn" type="button" aria-expanded="false" aria-controls="mega" class="inline-flex items-center gap-2 rounded-lg bg-flag text-white px-4 py-2.5 hover:bg-black transition">Choose Trek <span aria-hidden="true" class="text-sm">&#9662;</span></button>
   <a class="hidden xl:block nav-fx" href="{{ $homeUrl }}#updates">Updates</a>
   <a class="hidden xl:block nav-fx" href="{{ $homeUrl }}#why">Why us</a>
   <a class="hidden xl:block nav-fx" href="{{ $homeUrl }}#reviews">Reviews</a>
   <a class="hidden xl:block nav-fx" href="{{ $homeUrl }}#faq">FAQ</a>
   @auth
    @if(auth()->user()->is_admin)<a class="hidden xl:block nav-fx" href="{{ route('admin.dashboard') }}">Admin</a>@endif
    <a class="hidden lg:block nav-fx" href="{{ route('account') }}">{{ \Illuminate\Support\Str::limit(auth()->user()->name, 12) }}</a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="nav-fx">Logout</button></form>
   @else
    <a class="nav-fx" href="{{ route('login') }}">Login</a>
    <a class="hidden lg:inline-block border border-flag text-flag rounded-lg px-4 py-2 hover:bg-flag hover:text-white transition" href="{{ route('register') }}">Sign up</a>
   @endauth
   <a class="hidden sm:inline-block bg-flag text-white rounded-lg px-4 py-2.5 hover:bg-black transition" href="{{ $homeUrl }}#contact">Book now</a>
  </div>
 </div>

 {{-- Search box on phones --}}
 <form action="{{ route('search') }}" method="GET" role="search" class="md:hidden px-4 pb-3">
  <label for="hs2" class="sr-only">Search treks</label>
  <input id="hs2" type="search" name="q" value="{{ request('q') }}" list="trek-names" autocomplete="off" placeholder="Search treks..." class="w-full rounded-full border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-800 px-5 py-2.5 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
 </form>

 {{-- "Choose Trek" dropdown --}}
 <div id="mega" class="hidden absolute inset-x-0 top-full bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700 shadow-2xl rounded-b-2xl">
  <div class="max-w-7xl mx-auto px-5 py-6 max-h-[78vh] overflow-y-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-x-8 gap-y-8">
   <div class="min-w-0">
    <p class="{{ $headClass }}">Trek by name</p>
    <label for="mega-q" class="sr-only">Search treks by name</label>
    <input id="mega-q" type="search" placeholder="Search treks by name" autocomplete="off" class="w-full rounded-lg border-2 border-flag/70 bg-white dark:bg-slate-800 px-3 py-2.5 text-base outline-none focus:ring-2 focus:ring-flag/30">
    <ul id="mega-list" class="mt-2 max-h-[22rem] overflow-y-auto pr-1">
     @foreach($menu['treks'] as $t)
      <li data-name="{{ \Illuminate\Support\Str::lower($t['label']) }}"><a href="{{ $t['url'] }}" class="{{ $itemClass }}"><span class="truncate">{{ $t['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>
     @endforeach
    </ul>
   </div>
   <div class="min-w-0">
    <p class="{{ $headClass }}">Months</p>
    <ul>@foreach($menu['months'] as $i)<li><a href="{{ $i['url'] }}" class="{{ $itemClass }}"><span>{{ $i['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>@endforeach</ul>
   </div>
   <div class="min-w-0">
    <p class="{{ $headClass }}">Region</p>
    <ul>@foreach($menu['regions'] as $i)<li><a href="{{ $i['url'] }}" class="{{ $itemClass }}"><span>{{ $i['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>@endforeach</ul>
    <p class="{{ $headClass }} mt-8">Country</p>
    <ul>@foreach($menu['countries'] as $i)<li><a href="{{ $i['url'] }}" class="{{ $itemClass }}"><span>{{ $i['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>@endforeach</ul>
   </div>
   <div class="min-w-0">
    <p class="{{ $headClass }}">Season</p>
    <ul>@foreach($menu['seasons'] as $i)<li><a href="{{ $i['url'] }}" class="{{ $itemClass }}"><span>{{ $i['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>@endforeach</ul>
   </div>
   <div class="min-w-0">
    <p class="{{ $headClass }}">Grade</p>
    <ul>@foreach($menu['grades'] as $i)<li><a href="{{ $i['url'] }}" class="{{ $itemClass }}"><span>{{ $i['label'] }}</span><span class="text-slate-400" aria-hidden="true">&rsaquo;</span></a></li>@endforeach</ul>
   </div>
   <div class="col-span-full flex flex-wrap gap-x-6 gap-y-2 pt-4 border-t border-slate-200 dark:border-slate-700 text-base font-semibold">
     <a class="hover:text-flag" href="{{ $homeUrl }}#treks">All treks</a>
    <a class="hover:text-flag" href="{{ route('categories.index') }}">All categories</a>
    <a class="hover:text-flag" href="{{ $homeUrl }}#updates">Updates</a>
    <a class="hover:text-flag" href="{{ $homeUrl }}#why">Why us</a>
    <a class="hover:text-flag" href="{{ $homeUrl }}#reviews">Reviews</a>
    <a class="hover:text-flag" href="{{ $homeUrl }}#faq">FAQ</a>

    @auth
     <a class="hover:text-red-600" href="{{ route('account') }}">My account</a>
     @if(auth()->user()->is_admin)<a class="hover:text-red-600" href="{{ route('admin.dashboard') }}">Admin</a>@endif
    @else
     <a class="hover:text-red-600" href="{{ route('register') }}">Sign up</a>
    @endauth
    <a class="hover:text-red-600 sm:hidden" href="{{ $homeUrl }}#contact">Book now</a>
   </div>
  </div>
 </div>

 <datalist id="trek-names">
  @foreach($menu['treks'] as $t)<option value="{{ $t['label'] }}"></option>@endforeach
 </datalist>
</header>
