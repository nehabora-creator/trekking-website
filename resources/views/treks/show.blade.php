@extends('layouts.app')

@section('title', $trek->title.' Trek | '.setting('site_name', 'Himalaya Trails'))
@section('description', \Illuminate\Support\Str::limit(strip_tags((string) ($trek->overview ?: $trek->short_text)), 155))
@section('hide_categories', '1')

@php
    $imgs = $trek->images;
    $ft = $trek->altitudeFeet();
    $hl = lines($trek->highlights);
    $itin = lines($trek->itinerary);
    $inc = lines($trek->inclusions);
    $exc = lines($trek->exclusions);
    $ess = lines($trek->essentials);
    $enq = route('home', ['trek' => $trek->slug]).'#contact';
    $wa = 'https://wa.me/'.preg_replace('/\D/', '', (string) setting('whatsapp', '')).'?text='.rawurlencode('Hi, I want to know more about the '.$trek->title.' trek.');
    $tel = 'tel:'.preg_replace('/[^\d+]/', '', (string) setting('phone', ''));
    $regionName = $trek->region?->name;
    $stay = $regionName === 'Nepal' ? 'Hotel and teahouses' : 'Camps, homestays or guesthouses';
    $gradients = ['from-sky-700', 'from-emerald-700', 'from-violet-700', 'from-amber-700', 'from-rose-700'];
    $grad = $gradients[$trek->id % count($gradients)];
    $slideCount = max($imgs->count(), 1);
    $facts = array_filter([
        'Base camp' => $trek->base_camp,
        'Duration' => $trek->days.' days',
        'Max altitude' => $trek->max_altitude ? number_format($trek->max_altitude).' m / '.number_format($ft).' ft' : null,
        'Trekking' => $trek->distance_km ? '~'.$trek->distance_km.' km' : null,
        'Grade' => $trek->grade,
    ]);
    $info = array_filter([
        'Trek name' => $trek->title,
        'Days' => $trek->days,
        'Base camp' => $trek->base_camp,
        'Season' => $trek->season,
        'Best months' => $trek->best_months,
        'Country' => $regionName === 'Nepal' ? 'Nepal' : 'India',
        'Max altitude' => $trek->max_altitude ? number_format($trek->max_altitude).' m / '.number_format($ft).' ft' : null,
        'Grade' => $trek->grade,
        'Stay' => $stay,
        'Food' => 'Vegetarian meals during the trek',
    ], fn ($v) => $v !== null && $v !== '');
    $firstOpen = collect($months)->search(fn ($m) => $m['items']->count() > 0);
    $nextDeps = collect($months)->flatMap(fn ($m) => $m['items'])->take(3);
    $tabs = [['t-over', 'Overview'], ['t-iti', 'Itinerary'], ['t-dep', 'Fixed Departures'], ['t-gal', 'Gallery'], ['t-inc', 'Inclusions'], ['t-ess', 'Trek essentials'], ['t-cxl', 'Cancellation']];
    $card = 'rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700';
@endphp

@section('content')
<div class="max-w-6xl mx-auto px-5 pt-6">
 <a href="{{ route('home') }}#treks" class="text-flag font-semibold hover:underline">&#8592; All treks</a>

 {{-- Two sections: content on the left, booking box on the right --}}
 <div class="mt-4 grid grid-cols-1 lg:grid-cols-3 gap-x-8 gap-y-6 items-start">

  {{-- LEFT, top: photo gallery banner + quick facts --}}
  <div class="min-w-0 lg:col-span-2 lg:col-start-1 lg:row-start-1">
   <div id="gal" class="relative h-72 sm:h-[420px] rounded-2xl overflow-hidden bg-slate-700">
    @forelse($imgs as $i => $im)
     <img src="{{ img_url($im->path) }}" alt="{{ $trek->title }} photo {{ $i + 1 }}" class="gslide absolute inset-0 w-full h-full object-cover {{ $i === 0 ? '' : 'opacity-0' }}">
    @empty
     <div class="gslide absolute inset-0 bg-gradient-to-br {{ $grad }} to-slate-900"></div>
    @endforelse
    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent pointer-events-none"></div>
    <div class="absolute bottom-0 p-6 md:p-8 text-white pointer-events-none">
     @if($regionName)<span class="inline-block bg-flag rounded px-3 py-1 text-sm font-semibold">{{ $regionName }}</span>@endif
     <h1 class="mt-3 font-display font-extrabold text-3xl md:text-5xl">{{ $trek->title }} Trek</h1>
     @if($trek->short_text)<p class="mt-2 max-w-xl text-white/90">{{ $trek->short_text }}</p>@endif
    </div>
    @if($imgs->count() > 1)
     <button type="button" data-gp aria-label="Previous photo" class="absolute z-10 left-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/60 text-white text-2xl leading-none">&#8249;</button>
     <button type="button" data-gn aria-label="Next photo" class="absolute z-10 right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/60 text-white text-2xl leading-none">&#8250;</button>
    @endif
    <span id="gcount" class="absolute z-10 top-4 right-4 rounded-full bg-black/50 text-white text-sm px-3 py-1">1 / {{ $slideCount }}</span>
    @if($imgs->count())<a href="#t-gal" data-s="t-gal" class="absolute z-10 top-4 left-4 rounded-lg bg-white/90 text-slate-800 text-sm font-semibold px-4 py-2 hover:bg-white">View all photos</a>@endif
   </div>
   @if($imgs->count() > 1)
    <div class="mt-3 flex gap-3 overflow-x-auto noscroll">
     @foreach($imgs as $i => $im)
      <button type="button" data-g="{{ $i }}" aria-label="Show photo {{ $i + 1 }}" class="shrink-0 w-28 h-20 rounded-lg overflow-hidden border-2 {{ $i === 0 ? 'border-flag' : 'border-transparent' }} hover:border-flag"><img src="{{ img_url($im->path) }}" alt="" class="w-full h-full object-cover"></button>
     @endforeach
    </div>
   @endif
   <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-3">
    @foreach($facts as $label => $value)
     <div class="{{ $card }} p-4 text-center last:col-span-2 md:last:col-span-1"><p class="text-xs uppercase tracking-wide text-slate-500">{{ $label }}</p><p class="mt-1 font-display font-bold text-base md:text-lg">{{ $value }}</p></div>
    @endforeach
   </div>
  </div>

  {{-- RIGHT: booking box (stays in view while you scroll on big screens) --}}
  <aside class="min-w-0 lg:col-start-3 lg:row-start-1 lg:row-span-2 lg:sticky lg:top-24 self-start">
   <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-xl p-5 grid grid-cols-1 gap-4">
    <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
     <p class="text-sm text-slate-500">{{ $trek->price ? 'Starting from' : 'Price' }}</p>
     <div class="flex flex-wrap items-baseline gap-x-2">
      @if($trek->price)
       <p class="font-display font-extrabold text-3xl">&#8377;{{ number_format($trek->price) }}</p>
       @if($trek->price_note)<span class="text-sm font-semibold">{{ $trek->price_note }}</span>@endif
      @else
       <p class="font-display font-extrabold text-3xl">On request</p>
      @endif
      <span class="text-sm text-slate-500">/person</span>
     </div>
     @if($trek->badge)<p class="mt-3 inline-block bg-flag text-white text-sm font-semibold px-3 py-1">{{ $trek->badge }}</p>@endif
    </div>
    <a href="{{ $enq }}" class="text-center rounded-lg bg-flag text-white font-semibold py-3 transition hover:bg-black">Enquire Now</a>
    @if(setting('phone'))<a href="{{ $tel }}" class="text-center rounded-lg border-2 border-flag text-flag font-semibold py-2.5 transition hover:bg-flag hover:text-white">Call {{ setting('phone') }}</a>@endif
    @if(setting('whatsapp'))<a href="{{ $wa }}" target="_blank" rel="noopener" class="text-center rounded-lg border-2 border-emerald-500 text-emerald-600 dark:text-emerald-400 font-semibold py-2.5 hover:bg-emerald-500 hover:text-black transition">Chat on WhatsApp</a>@endif

    @if($nextDeps->count())
     <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
      <p class="font-display font-bold text-lg">Next batches</p>
      <ul class="mt-2 grid grid-cols-1 gap-2 text-sm">
       @foreach($nextDeps as $d)
        <li class="flex items-center justify-between gap-2"><span>{{ $d->start_date->format('D, j M Y') }}</span><a href="{{ route('home', ['trek' => $trek->slug, 'batch' => $d->start_date->format('D j M Y')]) }}#contact" class="text-flag font-semibold underline">Enquire</a></li>
       @endforeach
      </ul>
      <a href="#t-dep" data-s="t-dep" class="mt-3 inline-block text-sm text-flag font-semibold underline">See all batches</a>
     </div>
    @endif

    @if(count($hl))
     <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
      <p class="font-display font-bold text-lg">Highlights</p>
      <ul class="mt-2 grid grid-cols-1 gap-1.5 text-sm text-slate-600 dark:text-slate-300">
       @foreach(array_slice($hl, 0, 5) as $x)<li class="flex gap-2"><span class="text-flag">&#10003;</span><span>{{ $x }}</span></li>@endforeach
      </ul>
     </div>
    @endif

    <div class="pt-4 border-t border-slate-200 dark:border-slate-700 text-sm text-slate-600 dark:text-slate-300">
     <p class="font-display font-bold text-lg text-slate-800 dark:text-slate-100">Talk to a trek expert</p>
     @if(setting('email'))<p class="mt-1">{{ setting('email') }}</p>@endif
     @if(setting('hours'))<p class="text-slate-500">{{ setting('hours') }}</p>@endif
    </div>
   </div>
  </aside>

  {{-- LEFT, below: tab strip and all sections --}}
  <div class="min-w-0 lg:col-span-2 lg:col-start-1 lg:row-start-2 grid grid-cols-1 gap-8">
   <div class="min-w-0">
    <div class="sticky top-[124px] md:top-16 z-20">
     <div class="relative bg-gradient-to-r from-flag to-[#ff7a72] shadow-md px-12 py-3 rounded-lg">
      <button type="button" data-tp aria-label="Previous tabs" class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white text-flag shadow text-xl leading-none">&#8249;</button>
      <div id="tabs" class="noscroll flex gap-3 overflow-x-auto scroll-smooth">
       @foreach($tabs as $n => $tab)
        <button type="button" data-s="{{ $tab[0] }}" class="shrink-0 rounded-md border border-white px-4 py-1.5 font-semibold {{ $n === 0 ? 'bg-white text-flag' : 'text-white' }} hover:bg-white hover:text-flag">{{ $tab[1] }}</button>
       @endforeach
      </div>
      <button type="button" data-tn aria-label="Next tabs" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white text-flag shadow text-xl leading-none">&#8250;</button>
     </div>
    </div>
   </div>

   <section id="t-over" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="font-display font-bold text-2xl md:text-3xl">{{ $trek->title }} Trek Overview</h2>
    <h3 class="mt-4 font-display font-bold text-xl">All about the {{ $trek->title }} Trek.</h3>
    @if($trek->overview)<p class="mt-3 text-slate-600 dark:text-slate-300">{!! nl2br(e($trek->overview)) !!}</p>@endif
    @if(count($hl))
     <ul class="mt-4 grid grid-cols-1 gap-2">
      @foreach($hl as $x)<li class="flex gap-2"><span class="text-flag">&#10003;</span><span>{{ $x }}</span></li>@endforeach
     </ul>
    @endif
    <div class="mt-6 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
     @foreach($info as $label => $value)
      <div class="flex justify-between gap-4 px-4 py-3 {{ $loop->odd ? 'bg-slate-50 dark:bg-slate-900/40' : '' }}"><span class="font-semibold">{{ $label }}</span><span class="text-right text-slate-600 dark:text-slate-300">{{ $value }}</span></div>
     @endforeach
    </div>
   </section>

   <section id="t-iti" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="text-center font-display font-bold text-3xl text-slate-700 dark:text-slate-100">Itinerary</h2>
    <div class="mx-auto mt-3 mb-6 h-0.5 w-16 bg-red-900 dark:bg-red-400"></div>
    @forelse($itin as $j => $day)
     <div class="flex gap-4">
      <div class="flex flex-col items-center">
       <span class="shrink-0 w-12 h-12 rounded-full bg-flag text-white font-bold text-sm flex items-center justify-center">D{{ $j + 1 }}</span>
       @if(! $loop->last)<span class="flex-1 w-px bg-slate-300 dark:bg-slate-600"></span>@endif
      </div>
      <div class="pb-6 pt-2"><p class="text-sm text-slate-500">Day {{ $j + 1 }}</p><h3 class="font-display font-bold text-lg">{{ $day }}</h3></div>
     </div>
    @empty
     <p class="text-slate-500">The day-by-day plan will be added soon.</p>
    @endforelse
    @if(count($itin))<p class="text-sm text-slate-500">Weather and trail conditions can change the plan.</p>@endif
   </section>

   <section id="t-dep" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <div class="flex items-center justify-center gap-3 rounded-lg bg-gradient-to-r from-flag to-[#ff7a72] text-white font-extrabold tracking-widest uppercase py-3 mb-5 shadow">@include('partials.icon', ['name' => 'calendar', 'size' => 22])<span>Fixed Departures</span></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-start">
     @foreach($months as $idx => $m)
      <details name="dep" @if($firstOpen !== false && $idx === $firstOpen) open @endif class="group rounded-xl bg-white dark:bg-slate-800 shadow border border-slate-200 dark:border-slate-700 px-5 py-3">
       <summary class="flex items-center justify-between gap-3 cursor-pointer font-bold tracking-wide list-none [&::-webkit-details-marker]:hidden"><span>{{ $m['label'] }}</span><span class="text-xs transition-transform group-open:rotate-180" aria-hidden="true">&#9660;</span></summary>
       @if($m['items']->count())
        <div class="grid grid-cols-1 gap-3 pt-3">
         @foreach($m['items'] as $d)
          @php
              $end = $d->start_date->copy()->addDays(max($trek->days - 1, 0));
              $seats = $d->seats_left === null ? 'Seats open' : ($d->seats_left === 0 ? 'Sold out' : $d->seats_left.' seats left');
              $dPrice = $d->price ?: $trek->price;
          @endphp
          <div class="flex flex-wrap items-center justify-between gap-3 rounded-lg border border-slate-200 dark:border-slate-700 p-3">
           <div><p class="font-semibold">{{ $d->start_date->format('D, j M Y') }}</p><p class="text-sm text-slate-500">to {{ $end->format('D, j M Y') }} &middot; {{ $trek->days }} days &middot; {{ $seats }}@if($dPrice) &middot; &#8377;{{ number_format($dPrice) }}@endif</p></div>
           @if($d->seats_left === 0)
            <span class="rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-500 font-semibold px-4 py-2 text-sm">Sold out</span>
           @else
            <a href="{{ route('home', ['trek' => $trek->slug, 'batch' => $d->start_date->format('D j M Y')]) }}#contact" class="rounded-lg bg-flag text-white font-semibold px-4 py-2 text-sm transition hover:bg-black">Enquire</a>
           @endif
          </div>
         @endforeach
        </div>
       @else
        <p class="pt-3 text-sm text-slate-500">No fixed batch this month. <a class="text-flag font-semibold underline" href="{{ $enq }}">Ask us for a custom date.</a></p>
       @endif
      </details>
     @endforeach
    </div>
   </section>

   <section id="t-gal" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="text-center font-display font-bold text-3xl text-slate-700 dark:text-slate-100">Gallery</h2>
    <div class="mx-auto mt-3 mb-6 h-0.5 w-16 bg-red-900 dark:bg-red-400"></div>
    @if($imgs->count())
     <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
      @foreach($imgs as $i => $im)
       <button type="button" data-gg="{{ $i }}" class="aspect-[4/3] rounded-lg overflow-hidden hover:opacity-90"><img src="{{ img_url($im->path) }}" alt="{{ $trek->title }} gallery photo {{ $i + 1 }}" loading="lazy" class="w-full h-full object-cover"></button>
      @endforeach
     </div>
    @else
     <p class="text-slate-500 text-center">Photos will be added soon.</p>
    @endif
   </section>

   <section id="t-inc" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="text-center font-display font-bold text-3xl text-slate-700 dark:text-slate-100">Inclusions and Exclusions</h2>
    <div class="mx-auto mt-3 mb-6 h-0.5 w-16 bg-red-900 dark:bg-red-400"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
     <div class="rounded-xl border border-slate-200 dark:border-slate-700 p-5"><h3 class="font-display font-bold text-lg mb-3">Inclusions</h3><ul class="grid grid-cols-1 gap-2">@foreach($inc as $x)<li class="flex gap-2"><span class="text-flag">&#10003;</span><span>{{ $x }}</span></li>@endforeach</ul></div>
     <div class="rounded-xl border border-slate-200 dark:border-slate-700 p-5"><h3 class="font-display font-bold text-lg mb-3">Exclusions</h3><ul class="grid grid-cols-1 gap-2">@foreach($exc as $x)<li class="flex gap-2"><span class="text-slate-400">&#10005;</span><span>{{ $x }}</span></li>@endforeach</ul></div>
    </div>
   </section>

   <section id="t-ess" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="text-center font-display font-bold text-3xl text-slate-700 dark:text-slate-100">Trek Essentials</h2>
    <div class="mx-auto mt-3 mb-6 h-0.5 w-16 bg-red-900 dark:bg-red-400"></div>
    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">@foreach($ess as $x)<li class="flex gap-2"><span class="text-flag">&#10003;</span><span>{{ $x }}</span></li>@endforeach</ul>
   </section>

   <section id="t-cxl" class="min-w-0 scroll-mt-40 {{ $card }} shadow-sm p-6 md:p-8">
    <h2 class="text-center font-display font-bold text-3xl text-slate-700 dark:text-slate-100">Cancellation Policy</h2>
    <div class="mx-auto mt-3 mb-6 h-0.5 w-16 bg-red-900 dark:bg-red-400"></div>
    <p class="text-slate-600 dark:text-slate-300">{!! nl2br(e($trek->cancellation ?: 'Please contact us for the cancellation and refund policy.')) !!}</p>
   </section>
  </div>
 </div>
</div>

{{-- ===== SIMILAR TREKS ===== --}}
@if($similar->count())
<section class="max-w-6xl mx-auto px-5 py-16">
 <h2 class="text-center font-display font-extrabold text-3xl md:text-4xl">Similar <span class="text-flag">Trek</span></h2>
 <div class="mx-auto mt-3 mb-10 h-0.5 w-20 bg-red-900 dark:bg-red-400"></div>
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
  @foreach($similar as $s)
   @php $sc = $s->images->first()?->path; @endphp
   <a href="{{ route('treks.show', $s->slug) }}" class="group rounded-xl overflow-hidden bg-white dark:bg-slate-800 shadow-lg block transition hover:-translate-y-1">
    <div class="relative h-72 overflow-hidden bg-gradient-to-br {{ $gradients[$s->id % count($gradients)] }} to-slate-900">
     @if($sc)<img src="{{ img_url($sc) }}" alt="{{ $s->title }}" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">@endif
     <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
     @if($s->badge)<span class="absolute top-6 left-0 bg-flag text-white text-sm px-6 py-1.5">{{ $s->badge }}</span>@endif
     <div class="absolute bottom-0 inset-x-0 p-5 flex justify-between text-white font-semibold text-xl"><span>{{ $s->days }}D | {{ max($s->days - 1, 0) }}N</span><span>{{ str_replace(' to ', '-', $s->grade) }}</span></div>
    </div>
    <div class="p-5 text-center">
     <h3 class="font-display font-bold text-xl text-red-900 dark:text-red-300">{{ $s->title }}</h3>
     <div class="mt-3 flex items-center justify-between text-sm">
      <span class="text-slate-500">@if($s->rating)<span class="text-amber-400">&#9733;</span> {{ number_format($s->rating, 1) }}@if($s->rating_count) | {{ $s->rating_count }}@endif @endif</span>
      <span class="text-flag font-semibold underline">View Details</span>
     </div>
    </div>
   </a>
  @endforeach
 </div>
</section>
@endif

{{-- Fixed bar on phones --}}
<div class="h-20 md:hidden"></div>
<div class="md:hidden fixed bottom-0 inset-x-0 z-30 bg-white/95 dark:bg-slate-900/95 backdrop-blur border-t border-slate-200 dark:border-slate-700 p-3 flex gap-3">
 <a href="{{ $enq }}" class="flex-1 text-center rounded-lg bg-flag text-white font-semibold py-3 hover:bg-black">Enquire now</a>
 <a href="#t-dep" data-s="t-dep" class="flex-1 text-center rounded-lg border-2 border-flag text-flag font-semibold py-3">Departures</a>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/trek.js') }}"></script>
@endpush
