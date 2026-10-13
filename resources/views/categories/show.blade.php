@extends('layouts.app')

@section('title', strip_tags($heading).' | '.setting('site_name', 'Himalaya Trails'))
@section('description', strip_tags($sub))
@section('hide_categories', '1')

@section('content')
<section class="bg-gradient-to-r from-slate-900 to-slate-700 text-white">
 <div class="max-w-6xl mx-auto px-5 py-12">
  <nav class="text-sm text-white/70" aria-label="Breadcrumb">
   <a href="{{ route('home') }}" class="hover:underline">Home</a> &rsaquo;
   <a href="{{ route('categories.index') }}" class="hover:underline">Categories</a> &rsaquo;
   <span>{{ $crumb }}</span>
  </nav>
  <h1 class="mt-3 font-display font-extrabold text-3xl md:text-5xl">{{ $heading }}</h1>
  <p class="mt-2 text-white/80">{{ $sub }}</p>
 </div>
</section>

{{-- Two sections: treks on the left, categories and help on the right --}}
<section class="max-w-6xl mx-auto px-5 py-12 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
 <div class="min-w-0 lg:col-span-2">
  @if($treks->count())
   <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    @foreach($treks as $t)
     @include('partials.trek-card', ['t' => $t])
    @endforeach
   </div>
  @else
   <div class="rounded-xl border border-dashed border-slate-300 dark:border-slate-600 p-10 text-center">
    <p class="text-lg text-slate-600 dark:text-slate-300">No treks found here yet.</p>
    <a href="{{ route('home') }}#treks" class="inline-block mt-4 rounded-lg bg-flag text-white font-semibold px-6 py-3 hover:bg-black transition">See all treks</a>
   </div>
  @endif
 </div>

 <aside class="min-w-0 lg:sticky lg:top-24 grid grid-cols-1 gap-6">
  <div class="rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm p-5">
   <h2 class="font-display font-bold text-xl">Browse by category</h2>
   @foreach(\App\Support\Categories::all() as $c)
    <div class="mt-4">
     <p class="text-xs font-bold tracking-widest uppercase text-slate-500">{{ $c['title'] }}</p>
     <div class="mt-2 flex flex-wrap gap-2">
      @foreach($c['items'] as $item)
       <a href="{{ $item['url'] }}" class="rounded-full border border-slate-300 dark:border-slate-600 px-3 py-1 text-sm font-semibold hover:border-flag hover:text-flag transition">{{ $item['label'] }}</a>
      @endforeach
     </div>
    </div>
   @endforeach
  </div>
  <div class="rounded-xl bg-gradient-to-br from-flag to-[#ff7a72] text-white shadow-sm p-5">
   <h2 class="font-display font-bold text-xl">Not sure which trek?</h2>
   <p class="mt-2 text-white/90">Tell us your dates and fitness level. We will suggest the right trek.</p>
   <a href="{{ route('home') }}#contact" class="inline-block mt-4 rounded-lg bg-white text-flag font-semibold px-5 py-2.5 hover:bg-black hover:text-white transition">Ask a trek expert</a>
  </div>
 </aside>
</section>
@endsection
