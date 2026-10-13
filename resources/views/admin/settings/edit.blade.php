@extends('admin.layout')
@section('title', 'Site settings')
@section('content')
<h1 class="font-display font-extrabold text-3xl">Site settings</h1>
<form method="POST" action="{{ route('admin.settings.update') }}" class="mt-6 max-w-2xl rounded-xl bg-white shadow-sm p-6 grid grid-cols-1 gap-5">
 @csrf @method('PUT')
 @foreach($keys as $key => $label)
  <div>
   <label for="s_{{ $key }}" class="block font-semibold mb-1.5">{{ $label }}</label>
   <input id="s_{{ $key }}" type="text" name="{{ $key }}" value="{{ old($key, setting($key)) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 outline-none focus:border-flag focus:ring-2 focus:ring-flag/30">
  </div>
 @endforeach
 <div><button type="submit" class="rounded-lg bg-flag text-white font-semibold px-6 py-3 hover:bg-black transition">Save settings</button></div>
</form>
@endsection
