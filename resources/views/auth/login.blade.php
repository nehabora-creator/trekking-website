@extends('layouts.app')

@section('title', 'Login | '.setting('site_name', 'Himalaya Trails'))

@section('hide_categories', '1')

@section('content')
<section class="max-w-md mx-auto px-5 py-14">
 <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-xl p-8">
  <h1 class="font-display font-extrabold text-3xl text-center">Welcome back</h1>
  <p class="mt-1 text-center text-slate-500">Log in to save treks and see your enquiries.</p>
  <form method="POST" action="{{ url('/login') }}" class="mt-6 grid grid-cols-1 gap-4">
   @csrf
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Email
    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   @error('email')<p class="text-sm text-red-600 dark:text-red-400 -mt-2">{{ $message }}</p>@enderror
   <label class="flex flex-col gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-300">Password
    <input type="password" name="password" required autocomplete="current-password" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base font-normal outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
   </label>
   @error('password')<p class="text-sm text-red-600 dark:text-red-400 -mt-2">{{ $message }}</p>@enderror
   <label class="flex items-center gap-2 text-base"><input type="checkbox" name="remember" value="1" class="w-4 h-4 accent-[#f23640]"> Remember me</label>
   <button type="submit" class="rounded-xl bg-flag text-white font-semibold text-lg px-6 py-3 hover:bg-black transition">Log in</button>
  </form>
  <p class="mt-6 text-center text-slate-600 dark:text-slate-400">New here? <a href="{{ route('register') }}" class="text-flag font-semibold underline">Create an account</a></p>
 </div>
</section>
@endsection
