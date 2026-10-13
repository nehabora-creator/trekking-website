@extends('admin.layout')
@section('title', 'Enquiries')
@section('content')
<h1 class="font-display font-extrabold text-3xl">Enquiries</h1>
<div class="mt-6 rounded-xl bg-white shadow-sm overflow-x-auto">
 <table class="w-full text-left">
  <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Date</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Trek</th><th class="px-4 py-3">Topic</th><th class="px-4 py-3">Status</th><th class="px-4 py-3"></th></tr></thead>
  <tbody>
   @forelse($items as $e)
    <tr class="border-t {{ $e->status === 'new' ? 'bg-amber-50/50' : '' }}">
     <td class="px-4 py-3 whitespace-nowrap">{{ $e->created_at->format('j M Y, H:i') }}</td>
     <td class="px-4 py-3">{{ $e->name }}</td>
     <td class="px-4 py-3">{{ $e->email }}</td>
     <td class="px-4 py-3">{{ $e->trek?->title ?? 'General' }}</td>
     <td class="px-4 py-3">{{ $e->topic }}</td>
     <td class="px-4 py-3"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $e->status === 'new' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-700' }}">{{ $e->status === 'new' ? 'New' : 'Done' }}</span></td>
     <td class="px-4 py-3 text-right"><a class="text-flag font-semibold underline" href="{{ route('admin.enquiries.show', $e) }}">Open</a></td>
    </tr>
   @empty
    <tr><td colspan="7" class="px-4 py-8 text-slate-500">No enquiries yet.</td></tr>
   @endforelse
  </tbody>
 </table>
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
