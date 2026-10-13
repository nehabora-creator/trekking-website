@extends('layouts.app')

@section('title', 'Sign up | '.setting('site_name', 'Himalaya Trails'))

@section('hide_categories', '1')

@section('content')
<section class="max-w-md mx-auto px-5 py-14">
 <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-xl p-8">
  <h1 class="font-display font-extrabold text-3xl text-center">Create your account</h1>
  <p class="mt-1 text-center text-slate-500">Save your favourite treks and track your enquiries.</p>
  <form method="POST" action="{{ url('/register') }}" class="mt-6 grid grid-cols-1 gap-4">
   @csrf
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Full name
    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   @error('name')<p class="text-sm text-red-600 dark:text-red-400 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Email
    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   @error('email')<p class="text-sm text-red-600 dark:text-red-400 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Password (8+ characters)
    <input type="password" name="password" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   @error('password')<p class="text-sm text-red-600 dark:text-red-400 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Confirm password
    <input type="password" name="password_confirmation" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   <button type="submit" class="rounded-xl bg-flag text-white font-semibold text-lg px-6 py-3 hover:bg-black transition">Sign up</button>
  </form>
  <p class="mt-6 text-center text-slate-600 dark:text-slate-400">Already have an account? <a href="{{ route('login') }}" class="text-flag font-semibold underline">Log in</a></p>
 </div>
</section>
@endsection
