@php
    $cardCover = $t->images->first()?->path;
    $cardGrads = ['from-sky-700', 'from-emerald-700', 'from-violet-700', 'from-amber-700', 'from-rose-700'];
@endphp
<article data-reveal class="group bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm overflow-hidden flex flex-col transition hover:shadow-xl hover:-translate-y-1">
 <a href="{{ route('treks.show', $t->slug) }}" class="relative block h-60 overflow-hidden bg-gradient-to-br {{ $cardGrads[$t->id % count($cardGrads)] }} to-slate-900">
  @if($cardCover)<img src="{{ img_url($cardCover) }}" alt="{{ $t->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110">@endif
  @if($t->region)<span class="absolute top-3 left-3 inline-flex items-center gap-1 bg-slate-900/90 text-white text-xs rounded px-2.5 py-1.5">@include('partials.icon', ['name' => 'pin', 'size' => 13]){{ $t->region->name }}</span>@endif
  @if($t->badge)<span class="absolute bottom-3 left-0 bg-flag text-white text-sm px-4 py-1">{{ $t->badge }}</span>@endif
 </a>
 <div class="p-4 flex flex-col gap-2 flex-1">
  <h3 class="font-display font-bold text-xl leading-snug">{{ $t->title }}</h3>
  <p class="text-sm uppercase tracking-wide text-slate-600 dark:text-slate-400"><b class="font-semibold">Duration:</b> {{ $t->days }} days</p>
  <p class="text-sm uppercase tracking-wide text-slate-600 dark:text-slate-400"><b class="font-semibold">Grade:</b> {{ $t->grade }}</p>
  <a href="{{ route('treks.show', $t->slug) }}" class="mt-auto text-center rounded py-2.5 font-semibold bg-flag text-white transition hover:bg-black">View Trek Details</a>
 </div>
</article>
