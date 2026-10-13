@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<h1 class="font-display font-extrabold text-3xl">Dashboard</h1>
<div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
 @foreach($counts as $label => $n)
  <div class="rounded-xl bg-white shadow-sm p-5"><p class="text-sm text-slate-500">{{ $label }}</p><p class="font-display font-extrabold text-3xl">{{ $n }}</p></div>
 @endforeach
</div>
<h2 class="mt-10 font-display font-bold text-xl">Latest enquiries</h2>
<div class="mt-3 rounded-xl bg-white shadow-sm overflow-x-auto">
 <table class="w-full text-left">
  <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Date</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Trek</th><th class="px-4 py-3">Status</th><th class="px-4 py-3"></th></tr></thead>
  <tbody>
   @forelse($latest as $e)
    <tr class="border-t"><td class="px-4 py-3 whitespace-nowrap">{{ $e->created_at->format('j M, H:i') }}</td><td class="px-4 py-3">{{ $e->name }}</td><td class="px-4 py-3">{{ $e->trek?->title ?? 'General' }}</td><td class="px-4 py-3">{{ $e->status === 'new' ? 'New' : 'Done' }}</td><td class="px-4 py-3 text-right"><a class="text-flag font-semibold underline" href="{{ route('admin.enquiries.show', $e) }}">Open</a></td></tr>
   @empty
    <tr><td colspan="5" class="px-4 py-6 text-slate-500">No enquiries yet.</td></tr>
   @endforelse
  </tbody>
 </table>
</div>
@endsection
