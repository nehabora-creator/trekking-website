@extends('admin.layout')
@section('title', $title)
@section('content')
<div class="flex flex-wrap items-center justify-between gap-3">
 <h1 class="font-display font-extrabold text-3xl">{{ $title }}</h1>
 <a href="{{ route($base.'.create') }}" class="rounded-lg bg-flag text-white font-semibold px-5 py-2.5 hover:bg-black transition">+ Add new</a>
</div>
<div class="mt-6 rounded-xl bg-white shadow-sm overflow-x-auto">
 <table class="w-full text-left">
  <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
   <tr>
    @foreach($columns as $key => $col)
     <th class="px-4 py-3">{{ is_array($col) ? $col[0] : $col }}</th>
    @endforeach
    <th class="px-4 py-3 text-right">Actions</th>
   </tr>
  </thead>
  <tbody>
   @forelse($items as $item)
    <tr class="border-t">
     @foreach($columns as $key => $col)
      @php
          $type = is_array($col) ? $col[1] : 'text';
          $value = $type === 'cover' ? ($item->images->first()?->path) : data_get($item, $key);
      @endphp
      <td class="px-4 py-3 align-middle">
       @if($type === 'image' || $type === 'cover')
        @if($value)<img src="{{ img_url($value) }}" alt="" class="w-16 h-12 object-cover rounded">@else<span class="text-slate-400">none</span>@endif
       @elseif($type === 'bool')
        <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $value ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ $value ? 'Yes' : 'No' }}</span>
       @elseif($type === 'limit')
        {{ \Illuminate\Support\Str::limit((string) $value, 70) }}
       @else
        {{ $value }}
       @endif
      </td>
     @endforeach
     <td class="px-4 py-3 text-right whitespace-nowrap">
      <a href="{{ route($base.'.edit', $item) }}" class="text-flag font-semibold underline">Edit</a>
      <form method="POST" action="{{ route($base.'.destroy', $item) }}" class="inline" onsubmit="return confirm('Delete this item?')">@csrf @method('DELETE')<button type="submit" class="ml-3 text-slate-500 hover:text-red-600 underline">Delete</button></form>
     </td>
    </tr>
   @empty
    <tr><td colspan="{{ count($columns) + 1 }}" class="px-4 py-8 text-slate-500">Nothing here yet. Click "Add new".</td></tr>
   @endforelse
  </tbody>
 </table>
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
