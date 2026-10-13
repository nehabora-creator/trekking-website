@extends('layouts.app')

@section('title', setting('site_name', 'Himalaya Trails').' | Plan Your Next Himalayan Trek')

@section('content')

{{-- ===== HOME BANNER (Admin > Home banner: photo + sale text, button, price, note) ===== --}}
<section id="top" class="relative h-[84vh] min-h-[560px] max-h-[800px] overflow-hidden bg-[#04152e] text-white" aria-roledescription="carousel" aria-label="Featured offers">
 <div id="slides">
  @forelse($slides as $i => $s)
   @php
       $hasPromo = $s->promo_top || $s->promo_main || $s->promo_year;
       $btnUrl = $s->button_url ? (str_starts_with($s->button_url, 'http') ? $s->button_url : url($s->button_url)) : null;
       $showBtn = $s->button_text && $btnUrl;
   @endphp
   <div class="slide absolute inset-0 {{ $i ? 'opacity-0 pointer-events-none' : '' }}">
    @if($s->image)<img src="{{ img_url($s->image) }}" alt="" class="absolute inset-0 w-full h-full object-cover" @if($i) loading="lazy" @endif>@endif
    <div class="absolute inset-0 bg-gradient-to-b from-[#04152e]/75 via-[#04152e]/35 to-[#04152e]/85"></div>
    <div class="relative z-10 h-full max-w-6xl mx-auto px-6 pt-8 pb-14 md:pt-10 flex flex-col items-center justify-between text-center">
     <div class="flex flex-col items-center">
      @if($hasPromo)
       <div class="promo">
        @if($s->promo_top)<span class="promo-top">{{ $s->promo_top }}</span>@endif
        @if($s->promo_main)<span class="promo-main">{{ $s->promo_main }}</span>@endif
        @if($s->promo_year)<span class="promo-year">{{ $s->promo_year }}</span>@endif
       </div>
      @endif
     </div>
     <div>
      @if($hasPromo && $showBtn)
       <a href="{{ $btnUrl }}" class="inline-block rounded-full bg-white text-flag font-semibold px-7 py-2 shadow-lg hover:bg-flag hover:text-white transition">{{ $s->button_text }}</a>
      @endif
     </div>
     <div class="w-full">
      @if($i === 0)<h1 class="slide-title">{{ $s->title }}</h1>@else<h2 class="slide-title">{{ $s->title }}</h2>@endif
      @if($s->price_text)
       <p class="mt-2 text-xl md:text-3xl italic uppercase tracking-wide"><span>{{ $s->price_label ?: 'Starts from' }}</span> <b class="text-[#ffd21f] font-extrabold">{{ $s->price_text }}</b></p>
      @elseif($s->subtitle)
       <p class="mt-2 text-lg md:text-2xl opacity-95">{{ $s->subtitle }}</p>
      @endif
      @if(! $hasPromo && $showBtn)
       <a href="{{ $btnUrl }}" class="inline-block mt-5 rounded-full bg-flag text-white font-semibold px-7 py-3 shadow-lg hover:bg-black transition">{{ $s->button_text }}</a>
      @endif
      @if($s->note)<p class="mt-3 text-sm text-white/75 md:text-right">{{ $s->note }}</p>@endif
     </div>
    </div>
   </div>
  @empty
   <div class="slide absolute inset-0">
    <div class="relative z-10 h-full max-w-6xl mx-auto px-6 flex flex-col items-center justify-center text-center">
     <h1 class="slide-title">{{ setting('site_name', 'Himalaya Trails') }}</h1>
     <a href="#treks" class="inline-block mt-5 rounded-full bg-flag text-white font-semibold px-7 py-3 hover:bg-black transition">Find your trek</a>
    </div>
   </div>
  @endforelse
 </div>
 <button id="prev" type="button" aria-label="Previous slide" class="absolute z-20 left-3 md:left-6 top-1/2 -translate-y-1/2 w-11 h-11 md:w-14 md:h-14 rounded-full bg-white text-flag shadow-lg text-3xl leading-none hover:bg-flag hover:text-white transition">&#8249;</button>
 <button id="next" type="button" aria-label="Next slide" class="absolute z-20 right-3 md:right-6 top-1/2 -translate-y-1/2 w-11 h-11 md:w-14 md:h-14 rounded-full bg-white text-flag shadow-lg text-3xl leading-none hover:bg-flag hover:text-white transition">&#8250;</button>
 <div id="dots" class="absolute z-20 bottom-4 inset-x-0 flex justify-center gap-2"></div>
</section>

{{-- ===== TREKS (chips, filters and carousel are drawn by js/home.js) ===== --}}
<section id="treks" class="py-16">
 <div class="max-w-6xl mx-auto px-5">
  <div class="text-center">
   <h2 class="font-display font-extrabold text-3xl md:text-5xl">Your Next Mountain Adventure Awaits</h2>
   <p class="mt-2 text-slate-600 dark:text-slate-400">Discover unforgettable trekking experiences, from peaceful forest trails to challenging Himalayan summits. Find the trek that matches your adventure style.</p>
   <div class="mx-auto mt-3 h-0.5 w-24 rounded bg-flag"></div>
  </div>
  <div class="relative mt-8" id="filterwrap">
   <div class="flex items-center gap-3">
    <button id="ft" type="button" aria-label="More filters" aria-expanded="false" aria-controls="more" class="shrink-0 w-12 h-12 rounded-full bg-black text-white dark:bg-white dark:text-black flex items-center justify-center"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h10M18 7h2M4 17h2M10 17h10"/><circle cx="16" cy="7" r="2"/><circle cx="8" cy="17" r="2"/></svg></button>
    <div id="chips" class="noscroll flex gap-3 overflow-x-auto py-1 scroll-smooth"></div>
    <button id="cn" type="button" aria-label="Scroll filters" class="shrink-0 w-11 h-11 rounded-full border-2 border-slate-800 dark:border-slate-200 text-2xl leading-none">&#8250;</button>
   </div>
   <div id="more" class="hidden absolute left-0 top-full mt-2 z-40 w-full sm:w-[46rem] max-w-full max-h-[70vh] overflow-y-auto rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 shadow-2xl p-4">
    <div class="flex flex-wrap items-center gap-3">
     <input id="q" type="search" placeholder="Search trek name" class="flex-1 min-w-[10rem] rounded-full border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-2 text-base text-inherit">
     <button id="reset" type="button" class="rounded-full border border-slate-300 dark:border-slate-600 px-4 py-2 text-sm font-semibold hover:border-flag">Clear all</button>
    </div>
    <div id="groups"></div>
   </div>
  </div>
  <div id="rbanner" class="hidden relative mt-8 h-40 sm:h-52 rounded-2xl overflow-hidden bg-slate-700">
   <img id="rbimg" alt="" class="absolute inset-0 w-full h-full object-cover">
   <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
   <div class="absolute bottom-0 p-5 text-white"><p id="rbt" class="font-display font-extrabold text-2xl sm:text-4xl"></p><p id="rbc" class="text-white/90"></p></div>
  </div>
  <h3 id="ttl" class="mt-8 font-display font-bold text-2xl md:text-3xl"></h3>
  <p id="tcount" class="mt-1 text-slate-500"></p>
  <div class="relative mt-6">
   <button id="gp" aria-label="Previous treks" class="absolute z-10 -left-3 top-1/3 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8249;</button>
   <div id="grid" class="noscroll flex gap-5 overflow-x-auto snap-x snap-mandatory py-4 px-1 scroll-smooth" aria-live="polite"></div>
   <button id="gn" aria-label="Next treks" class="absolute z-10 -right-3 top-1/3 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8250;</button>
  </div>
 </div>
</section>

{{-- ===== WHY US (Admin > Numbers and Why us points) ===== --}}
<div id="why">
 <div class="max-w-6xl mx-auto px-5 pt-16 pb-8">
  <div class="text-center">
   <h2 class="font-display font-extrabold text-3xl md:text-5xl">Why Trek With Us?</h2>
   <div class="mx-auto mt-3 h-0.5 w-24 rounded bg-flag"></div>
   <p class="mt-3 text-slate-600 dark:text-slate-400">Trusted by trekkers from every corner of the country.</p>
  </div>
 </div>
 <section class="pt-12 pb-20 bg-slate-100 dark:bg-slate-800/60">
  <div class="max-w-6xl mx-auto px-5">
   @if($stats->count())
   <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
    @foreach($stats as $i => $s)
    <div data-card class="rounded-2xl bg-white dark:bg-slate-800 border-2 {{ $i === 0 ? 'border-flag' : 'border-transparent' }} shadow-md px-5 py-7 text-center transition duration-300 hover:-translate-y-1 motion-reduce:transition-none">
     <span class="text-flag inline-block">@include('partials.icon', ['name' => $s->icon, 'size' => 40])</span>
     <p class="mt-3 font-display font-extrabold text-3xl"><span class="cnt" data-n="{{ $s->number }}">{{ number_format($s->number) }}</span>{{ $s->suffix }}</p>
     <h3 class="mt-1 font-display font-bold text-lg">{{ $s->title }}</h3>
     @if($s->caption)<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $s->caption }}</p>@endif
    </div>
    @endforeach
   </div>
   @endif
   @if($features->count())
   <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($features as $f)
    <div class="flex gap-4 items-start">
     <span class="shrink-0 w-12 h-12 rounded-full bg-flag/10 text-flag flex items-center justify-center">@include('partials.icon', ['name' => $f->icon, 'size' => 24])</span>
     <div><h3 class="font-display font-bold text-lg">{{ $f->title }}</h3><p class="text-slate-600 dark:text-slate-400">{{ $f->text }}</p></div>
    </div>
    @endforeach
   </div>
   @endif
  </div>
 </section>
</div>

{{-- ===== STAY INFORMED (Admin > Updates and articles) ===== --}}
<section id="updates" class="py-16 bg-white dark:bg-slate-800/40">
 <div class="max-w-6xl mx-auto px-5">
  <h2 class="font-display font-extrabold text-3xl md:text-4xl">Stay informed</h2>
  <p class="mt-2 mb-6 text-slate-600 dark:text-slate-400 max-w-2xl">Trek updates and articles from the mountains.</p>
  <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
   <div id="utabs" role="tablist" class="flex gap-2">
    <button type="button" role="tab" data-ut="update" aria-selected="true" class="rounded-full px-4 py-1.5 text-base font-semibold border bg-flag text-white border-flag">Trek updates</button>
    <button type="button" role="tab" data-ut="article" aria-selected="false" class="rounded-full px-4 py-1.5 text-base font-semibold border border-slate-300 dark:border-slate-600">Articles</button>
   </div>
   <span class="flex gap-2"><button id="up" type="button" aria-label="Previous" class="w-10 h-10 rounded-full bg-flag text-white text-2xl hover:bg-black transition">&#8249;</button><button id="un" type="button" aria-label="Next" class="w-10 h-10 rounded-full bg-flag text-white text-2xl hover:bg-black transition">&#8250;</button></span>
  </div>
  @foreach(['update' => $updates, 'article' => $articles] as $type => $list)
  <div data-up="{{ $type }}" class="noscroll flex gap-5 overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth {{ $type === 'update' ? '' : 'hidden' }}">
   @forelse($list as $post)
   <a href="{{ route('posts.show', $post->slug) }}" class="group relative snap-start shrink-0 w-72 sm:w-80 h-80 rounded-xl overflow-hidden block bg-slate-800">
    @if($post->image)<img src="{{ img_url($post->image) }}" alt="{{ $post->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover">@endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-4 text-white">
     <small class="opacity-80">{{ $type === 'update' ? 'Update' : 'Guide' }}</small>
     <h3 class="font-display font-bold text-xl">{{ $post->title }}</h3>
     <p class="popup-text text-base">{{ $post->excerpt }}</p>
    </div>
   </a>
   @empty
   <p class="text-slate-500">Nothing here yet.</p>
   @endforelse
  </div>
  @endforeach
 </div>
</section>

{{-- ===== REVIEWS (Admin > Reviews) ===== --}}
<section id="reviews" class="py-16">
 <div class="max-w-6xl mx-auto px-5">
  <div class="text-center">
   <h2 class="font-display font-extrabold text-3xl md:text-5xl">What Trekkers Say</h2>
   <div class="mx-auto mt-3 h-0.5 w-24 rounded bg-flag"></div>
   @if($reviewAvg)
   <div class="mt-5 inline-flex items-center gap-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full px-5 py-2 shadow-sm">
    <span class="font-semibold">Trekker reviews</span>
    <span class="font-display font-bold text-xl">{{ number_format($reviewAvg, 1) }}</span>
    <span class="text-amber-400 tracking-wider" aria-label="{{ $reviewAvg }} out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
    <span class="text-sm text-slate-500">({{ $reviews->count() }})</span>
   </div>
   @endif
  </div>
  <div class="relative mt-8">
   <button id="rp" type="button" aria-label="Previous reviews" class="absolute z-10 -left-3 top-1/2 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8249;</button>
   <div id="rcar" class="noscroll flex gap-5 overflow-x-auto snap-x snap-mandatory py-3 px-1 scroll-smooth">
    @forelse($reviews as $r)
    @php
        $rimg = $r->image ?: ($r->trek ? $r->trek->images->first()?->path : null);
        $colors = ['#2f6f7e', '#3c7a5a', '#6a5a9a', '#a0603a', '#4a6aa0', '#8a4a5a'];
    @endphp
    <article class="snap-start shrink-0 w-[290px] sm:w-[340px] bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm overflow-hidden flex flex-col">
     <div class="relative h-44 bg-slate-700">
      @if($rimg)<img src="{{ img_url($rimg) }}" alt="{{ $r->trek?->title ?? 'Trek photo' }}" loading="lazy" class="w-full h-full object-cover">@endif
      <span class="absolute left-4 -bottom-6 w-14 h-14 rounded-full border-4 border-white dark:border-slate-800 text-white text-xl font-bold flex items-center justify-center" style="background:{{ $colors[$loop->index % count($colors)] }}">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($r->name, 0, 1)) }}</span>
     </div>
     <div class="pt-9 px-5 pb-5 flex flex-col gap-2 flex-1">
      <div><h3 class="font-display font-bold text-lg leading-tight">{{ $r->name }}</h3>@if($r->trek)<p class="text-sm text-slate-500">{{ $r->trek->title }}</p>@endif</div>
      <p class="text-amber-400 tracking-wider" aria-label="{{ $r->rating }} out of 5 stars">{!! str_repeat('&#9733;', max(1, min(5, (int) $r->rating))) !!}</p>
      <p class="text-base text-slate-600 dark:text-slate-300 line-clamp-5">{{ $r->body }}</p>
     </div>
    </article>
    @empty
    <p class="text-slate-500">No reviews yet.</p>
    @endforelse
   </div>
   <button id="rn" type="button" aria-label="Next reviews" class="absolute z-10 -right-3 top-1/2 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8250;</button>
  </div>
 </div>
</section>

{{-- ===== FAQ (Admin > FAQ tabs and FAQ questions) ===== --}}
<section id="faq" class="py-16 bg-white dark:bg-slate-800/40">
 <div class="max-w-6xl mx-auto px-5">
  <div class="text-center">
   <h2 class="font-display font-extrabold text-3xl md:text-5xl">Frequently Asked Questions (FAQ)</h2>
   <div class="mx-auto mt-3 h-0.5 w-24 rounded bg-flag"></div>
  </div>
  @if($faqCategories->count())
  <div class="relative mt-8">
   <button id="tp" type="button" aria-label="Scroll tabs left" class="absolute z-10 left-0 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8249;</button>
   <div id="ftabs" role="tablist" class="noscroll flex gap-3 overflow-x-auto py-2 px-14 scroll-smooth">
    @foreach($faqCategories as $i => $c)
    <button type="button" role="tab" data-ft="{{ $i }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" class="shrink-0 inline-flex items-center gap-2 rounded-full border px-5 py-2.5 text-lg font-semibold whitespace-nowrap {{ $i === 0 ? 'bg-flag border-flag text-white' : 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:border-slate-500' }}">@include('partials.icon', ['name' => $c->icon, 'size' => 20]){{ $c->name }}</button>
    @endforeach
   </div>
   <button id="tn" type="button" aria-label="Scroll tabs right" class="absolute z-10 right-0 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white dark:bg-slate-700 shadow-lg text-2xl leading-none">&#8250;</button>
  </div>
  <div class="mt-6 max-w-4xl mx-auto">
   @foreach($faqCategories as $i => $c)
   <div data-fp="{{ $i }}" class="grid grid-cols-1 gap-3 {{ $i === 0 ? '' : 'hidden' }}">
    @foreach($c->faqs as $j => $f)
    <div class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
     <button type="button" data-fb aria-expanded="{{ $j === 0 ? 'true' : 'false' }}" class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 font-display font-bold text-lg"><span>{{ $f->question }}</span><span data-chev class="shrink-0 text-flag transition-transform duration-300 {{ $j === 0 ? 'rotate-180' : '' }}" aria-hidden="true">&#9662;</span></button>
     <div data-fbody class="grid grid-cols-1 transition-[grid-template-rows] duration-300 motion-reduce:transition-none {{ $j === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}"><div class="overflow-hidden"><p class="px-5 pb-5 text-slate-600 dark:text-slate-300">{{ $f->answer }}</p></div></div>
    </div>
    @endforeach
   </div>
   @endforeach
  </div>
  @endif
 </div>
</section>

{{-- ===== CONTACT (enquiries are saved in the database: Admin > Enquiries) ===== --}}
<section id="contact" class="relative py-20 overflow-hidden bg-gradient-to-b from-slate-100 to-slate-200 dark:from-slate-900 dark:to-slate-950">
 <svg class="absolute inset-x-0 bottom-0 w-full h-48 text-slate-300/60 dark:text-slate-800" viewBox="0 0 1200 190" preserveAspectRatio="none" aria-hidden="true"><path d="M0 120 L120 70 L210 105 L330 40 L430 95 L540 55 L660 110 L780 30 L890 90 L1010 60 L1110 100 L1200 70 V190 H0Z" fill="currentColor"/></svg>
 <div class="relative max-w-6xl mx-auto px-5">
  <div class="text-center mb-10">
   <h2 class="font-display font-extrabold text-3xl md:text-5xl">Book or Ask a Question</h2>
   <div class="mx-auto mt-3 h-0.5 w-24 rounded bg-flag"></div>
   <p class="mt-3 text-slate-600 dark:text-slate-400 max-w-xl mx-auto">Tell us the trek and month you have in mind. We will reply with dates, prices and the next steps.</p>
  </div>
  <div class="grid grid-cols-1 lg:grid-cols-5 rounded-3xl overflow-hidden shadow-2xl bg-white dark:bg-slate-800">
   <aside class="lg:col-span-2 relative text-white p-8 md:p-10 bg-slate-600 overflow-hidden">
    @php $contactImg = $treks->first(fn ($t) => $t->images->count())?->images->first()?->path; @endphp
    @if($contactImg)<img src="{{ img_url($contactImg) }}" alt="" class="absolute inset-0 w-full h-full object-cover">@endif
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/55 to-black/80"></div>
    <div class="relative flex flex-col gap-7 h-full">
     <div><h3 class="font-display font-extrabold text-3xl leading-tight">Let's plan your Himalayan trek</h3><p class="mt-2 text-white/80">Not sure where to start? Share your dates and fitness level and we will suggest the right trek.</p></div>
     <ul class="grid grid-cols-1 gap-5">
      <li class="flex items-start gap-4"><span class="shrink-0 w-11 h-11 rounded-full bg-white/15 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/></svg></span><span><b class="block text-sm uppercase tracking-wide text-white/70">Call us</b>{{ setting('phone', '') }}</span></li>
      <li class="flex items-start gap-4"><span class="shrink-0 w-11 h-11 rounded-full bg-white/15 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span><span><b class="block text-sm uppercase tracking-wide text-white/70">Email us</b>{{ setting('email', '') }}</span></li>
      <li class="flex items-start gap-4"><span class="shrink-0 w-11 h-11 rounded-full bg-white/15 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s7-6 7-11a7 7 0 0 0-14 0c0 5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span><span><b class="block text-sm uppercase tracking-wide text-white/70">Visit us</b>{{ setting('address', '') }}</span></li>
      <li class="flex items-start gap-4"><span class="shrink-0 w-11 h-11 rounded-full bg-white/15 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><span><b class="block text-sm uppercase tracking-wide text-white/70">Open hours</b>{{ setting('hours', '') }}</span></li>
     </ul>
     @if(setting('whatsapp'))
     <a href="https://wa.me/{{ preg_replace('/\D/', '', setting('whatsapp')) }}?text={{ rawurlencode('Hi, I want to know about a trek') }}" target="_blank" rel="noopener" class="mt-auto inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black font-semibold px-6 py-3 transition">Chat on WhatsApp</a>
     @endif
    </div>
   </aside>

   <form id="form" method="POST" action="{{ route('enquiry.store') }}" class="lg:col-span-3 p-8 md:p-10 grid grid-cols-1 gap-5 text-slate-800 dark:text-slate-100">
    @csrf
    <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
    <input type="hidden" name="topic" id="topic" value="{{ old('topic', 'Book a trek') }}">
    <input type="hidden" name="batch" id="batch" value="{{ old('batch', request('batch')) }}">
    @if(session('success'))
    <p role="status" class="rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 font-semibold px-4 py-3">{{ session('success') }}</p>
    @endif
    @if($errors->any() && old('name') !== null)
    <div role="alert" class="rounded-xl bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 px-4 py-3 text-base"><ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div>
     <p class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-2">I want to</p>
     <div id="topics" class="flex flex-wrap gap-2"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Your name<input name="name" value="{{ old('name', auth()->user()?->name) }}" required autocomplete="name" placeholder="Full name" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30"></label>
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Email<input name="email" type="email" value="{{ old('email', auth()->user()?->email) }}" required autocomplete="email" placeholder="you@example.com" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30"></label>
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Phone<input name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" placeholder="+91" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30"></label>
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Trek
      <select name="trek" id="trek" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
       <option value="">Which trek?</option>
       @foreach($treks as $t)<option value="{{ $t->slug }}" @selected(old('trek', request('trek')) === $t->slug)>{{ $t->title }}</option>@endforeach
      </select></label>
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Preferred month
      <select name="month" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
       <option value="">Any month</option>
       @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)<option @selected(old('month') === $m)>{{ $m }}</option>@endforeach
      </select></label>
     <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Group size
      <select name="group_size" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
       @foreach(['Just me','2 people','3 to 5 people','6 to 10 people','More than 10'] as $g)<option @selected(old('group_size') === $g)>{{ $g }}</option>@endforeach
      </select></label>
    </div>
    <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Message<textarea name="message" rows="4" placeholder="Tell us about your fitness level, dates or any questions" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">{{ old('message', request('batch') ? 'Preferred batch: '.request('batch') : '') }}</textarea></label>
    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-flag text-white font-semibold text-lg px-6 py-3.5 shadow-lg hover:bg-black hover:-translate-y-0.5 transition">Send enquiry <span aria-hidden="true">&#8594;</span></button>
    <p class="text-xs text-slate-500 -mt-3">We only use your details to reply to this enquiry.</p>
   </form>
  </div>
 </div>
</section>
@endsection

@push('scripts')
<script>window.APP = @json($appData);</script>
<script src="{{ asset('js/home.js') }}"></script>
@endpush
