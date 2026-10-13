@extends('layouts.app')

@section('title', 'My account | '.setting('site_name', 'Himalaya Trails'))

@section('content')
@php $input = 'w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30'; @endphp
<section class="max-w-6xl mx-auto px-5 py-10">
 <h1 class="font-display font-extrabold text-3xl md:text-4xl">Hello, {{ $user->name }}</h1>
 @if(session('success'))<p class="mt-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 font-semibold px-4 py-3">{{ session('success') }}</p>@endif

 <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
  <form method="POST" action="{{ route('account.update') }}" class="min-w-0 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow p-6 grid grid-cols-1 gap-4">
   @csrf @method('PUT')
   <h2 class="font-display font-bold text-xl">My details</h2>
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Name<input name="name" value="{{ old('name', $user->name) }}" required class="{{ $input }}"></label>
   @error('name')<p class="text-sm text-red-600 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Email<input type="email" name="email" value="{{ old('email', $user->email) }}" required class="{{ $input }}"></label>
   @error('email')<p class="text-sm text-red-600 -mt-2">{{ $message }}</p>@enderror
   <p class="text-sm text-slate-500">To change your password, fill these three boxes. Otherwise leave them empty.</p>
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Current password<input type="password" name="current_password" autocomplete="current-password" class="{{ $input }}"></label>
   @error('current_password')<p class="text-sm text-red-600 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">New password<input type="password" name="password" autocomplete="new-password" class="{{ $input }}"></label>
   @error('password')<p class="text-sm text-red-600 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Confirm new password<input type="password" name="password_confirmation" autocomplete="new-password" class="{{ $input }}"></label>
   <button type="submit" class="rounded-xl bg-flag text-white font-semibold px-6 py-3 hover:bg-black transition">Save changes</button>
  </form>

  <div class="lg:col-span-2 min-w-0 grid grid-cols-1 gap-8">
   <div>
    <h2 class="font-display font-bold text-2xl">Saved treks</h2>
    @if($favorites->count())
     <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-5">
      @foreach($favorites as $t)
       @php $cover = $t->images->first()?->path; @endphp
       <a href="{{ route('treks.show', $t->slug) }}" class="group rounded-xl overflow-hidden bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm block hover:shadow-lg transition">
        <div class="h-40 bg-gradient-to-br from-sky-700 to-slate-900 overflow-hidden">@if($cover)<img src="{{ img_url($cover) }}" alt="{{ $t->title }}" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">@endif</div>
        <div class="p-4"><h3 class="font-display font-bold text-lg">{{ $t->title }}</h3><p class="text-sm text-slate-500">{{ $t->region?->name }} &middot; {{ $t->days }} days &middot; {{ $t->grade }}</p></div>
       </a>
      @endforeach
     </div>
    @else
     <p class="mt-3 text-slate-500">You have not saved any trek yet. Tap the heart on a trek card to save it.</p>
    @endif
   </div>

   <div>
    <h2 class="font-display font-bold text-2xl">My enquiries</h2>
    @if($enquiries->count())
     <div class="mt-4 rounded-xl border border-slate-200 dark:border-slate-700 overflow-x-auto bg-white dark:bg-slate-800">
      <table class="w-full text-left text-base">
       <thead class="bg-slate-50 dark:bg-slate-900/50 text-sm uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Date</th><th class="px-4 py-3">Trek</th><th class="px-4 py-3">Topic</th><th class="px-4 py-3">Status</th></tr></thead>
       <tbody>
        @foreach($enquiries as $e)
         <tr class="border-t border-slate-200 dark:border-slate-700"><td class="px-4 py-3 whitespace-nowrap">{{ $e->created_at->format('j M Y') }}</td><td class="px-4 py-3">{{ $e->trek?->title ?? 'General' }}</td><td class="px-4 py-3">{{ $e->topic }}</td><td class="px-4 py-3">{{ $e->status === 'done' ? 'Replied' : 'Received' }}</td></tr>
        @endforeach
       </tbody>
      </table>
     </div>
    @else
     <p class="mt-3 text-slate-500">No enquiries yet. <a href="{{ route('home') }}#contact" class="text-flag font-semibold underline">Send one</a>.</p>
    @endif
   </div>
  </div>
 </div>
</section>
@endsection
