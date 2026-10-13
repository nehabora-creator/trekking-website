@extends('admin.layout')
@section('title', 'Enquiry')
@section('content')
<a href="{{ route('admin.enquiries.index') }}" class="text-flag font-semibold hover:underline">&#8592; Enquiries</a>
<h1 class="mt-2 font-display font-extrabold text-3xl">Enquiry from {{ $item->name }}</h1>
<div class="mt-6 max-w-3xl rounded-xl bg-white shadow-sm p-6 grid grid-cols-1 gap-3">
 @php
     $rows = [
         'Received' => $item->created_at->format('j M Y, H:i'),
         'Email' => $item->email,
         'Phone' => $item->phone,
         'Trek' => $item->trek?->title,
         'Topic' => $item->topic,
         'Preferred month' => $item->month,
         'Preferred batch' => $item->batch,
         'Group size' => $item->group_size,
         'Account' => $item->user ? $item->user->name.' ('.$item->user->email.')' : 'Not logged in',
     ];
 @endphp
 @foreach($rows as $label => $value)
  @if($value)<div class="flex flex-wrap gap-x-4"><span class="w-40 font-semibold text-slate-500">{{ $label }}</span><span>{{ $value }}</span></div>@endif
 @endforeach
 <div class="mt-2"><p class="font-semibold text-slate-500">Message</p><p class="mt-1 whitespace-pre-line">{{ $item->message ?: '-' }}</p></div>
 <div class="mt-4 flex flex-wrap gap-3">
  <a href="mailto:{{ $item->email }}?subject={{ rawurlencode('Your trek enquiry') }}" class="rounded-lg bg-flag text-white font-semibold px-5 py-2.5 hover:bg-black transition">Reply by email</a>
  <form method="POST" action="{{ route('admin.enquiries.update', $item) }}">@csrf @method('PATCH')<button type="submit" class="rounded-lg border border-slate-300 px-5 py-2.5 font-semibold hover:border-flag">{{ $item->status === 'new' ? 'Mark as done' : 'Mark as new' }}</button></form>
  <form method="POST" action="{{ route('admin.enquiries.destroy', $item) }}" onsubmit="return confirm('Delete this enquiry?')">@csrf @method('DELETE')<button type="submit" class="rounded-lg border border-slate-300 px-5 py-2.5 font-semibold text-slate-500 hover:text-red-600">Delete</button></form>
 </div>
</div>
@endsection
