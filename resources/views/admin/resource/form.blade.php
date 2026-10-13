@extends('admin.layout')
@section('title', ($item->exists ? 'Edit ' : 'Add ').$title)
@section('content')
@php $inputClass = 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-base outline-none focus:border-flag focus:ring-2 focus:ring-flag/30'; @endphp
<a href="{{ route($base.'.index') }}" class="text-flag font-semibold hover:underline">&#8592; {{ $title }}</a>
<h1 class="mt-2 font-display font-extrabold text-3xl">{{ $item->exists ? 'Edit' : 'Add new' }}</h1>

<form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route($base.'.update', $item) : route($base.'.store') }}" class="mt-6 max-w-3xl rounded-xl bg-white shadow-sm p-6 grid grid-cols-1 gap-5">
 @csrf
 @if($item->exists) @method('PUT') @endif

 @foreach($fields as $name => $f)
  @php
      $type = $f['type'];
      $current = $item->exists ? $item->{$name} : ($f['default'] ?? null);
      $value = old($name, $current);
  @endphp

  @if($type === 'checkbox')
   <label class="flex items-center gap-3 font-semibold"><input type="checkbox" name="{{ $name }}" value="1" @checked($value) class="w-5 h-5 accent-[#f23640]"> {{ $f['label'] }}</label>

  @elseif($type === 'image')
   <div>
    <label class="block font-semibold mb-1.5">{{ $f['label'] }}</label>
    @if($item->exists && $item->{$name})<img src="{{ img_url($item->{$name}) }}" alt="" class="mb-3 h-28 rounded-lg object-cover">@endif
    <input type="file" name="{{ $name }}" accept="image/*" class="block w-full text-sm">
    @if(! empty($f['help']))<p class="mt-1 text-sm text-slate-500">{{ $f['help'] }}</p>@endif
   </div>

  @elseif($type === 'images')
   <div>
    <label class="block font-semibold mb-1.5">{{ $f['label'] }}</label>
    @if($item->exists && $item->images->count())
     <p class="text-sm text-slate-500 mb-2">Tick a photo to remove it when you save. The first photo is the cover.</p>
     <div class="grid grid-cols-3 sm:grid-cols-4 gap-3 mb-3">
      @foreach($item->images as $im)
       <label class="block relative cursor-pointer"><img src="{{ img_url($im->path) }}" alt="" class="h-24 w-full object-cover rounded-lg"><span class="absolute left-1 top-1 bg-white/90 rounded px-1.5 py-0.5 text-xs font-semibold flex items-center gap-1"><input type="checkbox" name="remove_images[]" value="{{ $im->id }}"> Remove</span></label>
      @endforeach
     </div>
    @endif
    <input type="file" name="images[]" accept="image/*" multiple class="block w-full text-sm">
    <p class="mt-1 text-sm text-slate-500">You can choose many photos at once. New photos are added after the existing ones.</p>
   </div>

  @else
   <div>
    <label for="f_{{ $name }}" class="block font-semibold mb-1.5">{{ $f['label'] }}</label>
    @if($type === 'textarea')
     <textarea id="f_{{ $name }}" name="{{ $name }}" rows="{{ $f['rows'] ?? 4 }}" class="{{ $inputClass }}">{{ $value }}</textarea>
    @elseif($type === 'select')
     <select id="f_{{ $name }}" name="{{ $name }}" class="{{ $inputClass }}">
      <option value="">- choose -</option>
      @foreach($f['options'] as $optValue => $optLabel)
       <option value="{{ $optValue }}" @selected((string) $value === (string) $optValue)>{{ $optLabel }}</option>
      @endforeach
     </select>
    @elseif($type === 'number')
     <input id="f_{{ $name }}" type="number" step="{{ $f['step'] ?? 1 }}" name="{{ $name }}" value="{{ $value }}" class="{{ $inputClass }}">
    @else
     <input id="f_{{ $name }}" type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $inputClass }}">
    @endif
    @if(! empty($f['help']))<p class="mt-1 text-sm text-slate-500">{{ $f['help'] }}</p>@endif
   </div>
  @endif
 @endforeach

 <div class="flex gap-3">
  <button type="submit" class="rounded-lg bg-flag text-white font-semibold px-6 py-3 hover:bg-black transition">Save</button>
  <a href="{{ route($base.'.index') }}" class="rounded-lg border border-slate-300 px-6 py-3 font-semibold hover:border-flag">Cancel</a>
 </div>
</form>

@if($item->exists && $extra)
 @include($extra, ['item' => $item])
@endif
@endsection
