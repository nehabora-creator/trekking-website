@extends('layouts.app')

@section('title', $post->title.' | '.setting('site_name', 'Himalaya Trails'))
@section('description', \Illuminate\Support\Str::limit((string) $post->excerpt, 155))
@section('hide_categories', '1')

@section('content')
<div class="max-w-6xl mx-auto px-5 py-10">
 <a href="{{ route('home') }}#updates" class="text-flag font-semibold hover:underline">&#8592; Back</a>

 {{-- Two sections: the article and a side box --}}
 <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
  <article class="min-w-0 lg:col-span-2">
   <p class="text-sm uppercase tracking-wide text-slate-500">{{ $post->type === 'update' ? 'Trek update' : 'Guide' }} &middot; {{ $post->created_at->format('j M Y') }}</p>
   <h1 class="mt-2 font-display font-extrabold text-3xl md:text-5xl">{{ $post->title }}</h1>
   @if($post->image)<img src="{{ img_url($post->image) }}" alt="{{ $post->title }}" class="mt-6 w-full max-h-[420px] object-cover rounded-2xl">@endif
   @if($post->excerpt)<p class="mt-6 text-xl text-slate-600 dark:text-slate-300">{{ $post->excerpt }}</p>@endif
   @if($post->body)<div class="mt-6 text-slate-700 dark:text-slate-200 leading-relaxed">{!! nl2br(e($post->body)) !!}</div>@endif
  </article>

  <aside class="min-w-0 lg:sticky lg:top-24 grid grid-cols-1 gap-6">
   <div class="rounded-xl bg-gradient-to-br from-flag to-[#ff7a72] text-white shadow-sm p-5">
    <h2 class="font-display font-bold text-xl">Plan your trek with us</h2>
    <p class="mt-2 text-white/90">Ask about dates, prices and the right trek for you.</p>
    <a href="{{ route('home') }}#contact" class="inline-block mt-4 rounded-lg bg-white text-flag font-semibold px-5 py-2.5 hover:bg-black hover:text-white transition">Send an enquiry</a>
   </div>
   @if($others->count())
    <div class="rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm p-5">
     <h2 class="font-display font-bold text-xl">More to read</h2>
     <ul class="mt-3 grid grid-cols-1 gap-3">
      @foreach($others as $o)
       <li><a href="{{ route('posts.show', $o->slug) }}" class="flex gap-3 items-center group">
        @if($o->image)<img src="{{ img_url($o->image) }}" alt="" loading="lazy" class="w-16 h-16 rounded-lg object-cover shrink-0">@endif
        <span><span class="block font-semibold group-hover:text-flag">{{ $o->title }}</span><span class="block text-sm text-slate-500">{{ $o->type === 'update' ? 'Update' : 'Guide' }}</span></span>
       </a></li>
      @endforeach
     </ul>
    </div>
   @endif
  </aside>
 </div>
</div>
@endsection
