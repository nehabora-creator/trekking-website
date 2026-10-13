@php $cats = \App\Support\Categories::all(); @endphp
@if(count($cats))
<section id="categories" class="py-14 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800">
 <div class="max-w-7xl mx-auto px-5">
  <h2 class="font-display font-extrabold text-3xl md:text-4xl">Treks by Categories</h2>
  <div class="mt-3 mb-8 h-0.5 bg-flag/40"></div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-6 gap-5">
   @foreach($cats as $c)
    <div data-reveal class="relative overflow-hidden rounded-3xl bg-white dark:bg-slate-800 shadow-lg border border-slate-100 dark:border-slate-700 p-5 min-h-[18rem]">
     <h3 class="font-display font-bold text-lg pb-2 border-b-2 border-flag/20">{{ $c['title'] }}</h3>
     <ul class="relative z-10 mt-4 grid {{ count($c['items']) > 8 ? 'grid-cols-2' : 'grid-cols-1' }} gap-x-4 gap-y-1.5 text-[15px]">
      @foreach($c['items'] as $item)
       <li><a href="{{ $item['url'] }}" class="hover:text-flag hover:underline">{{ $item['label'] }}</a></li>
      @endforeach
     </ul>
     <span class="absolute -bottom-5 -right-5 text-flag/10 pointer-events-none" aria-hidden="true">@include('partials.icon', ['name' => $c['icon'], 'size' => 130])</span>
    </div>
   @endforeach
  </div>
 </div>
</section>
@endif
