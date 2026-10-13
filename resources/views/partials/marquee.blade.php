@php
    $mq = \App\Support\Categories::marquee();
    $mqEmoji = ['Winter' => '&#10052;', 'Spring' => '&#127800;', 'Summer' => '&#9728;', 'Monsoon' => '&#127783;', 'Autumn' => '&#127810;'];
@endphp
<div class="marquee bg-flag text-white text-sm font-semibold" role="region" aria-label="Treks open this season">
 <div class="marquee-track">
  @for($rep = 0; $rep < 2; $rep++)
   <div class="marquee-group" @if($rep === 1) aria-hidden="true" @endif>
    <span>{!! $mqEmoji[$mq['season']] ?? '' !!} {{ $mq['season'] }} season in {{ $mq['month'] }}:
     @if(count($mq['treks'])) these treks are open for booking @else plan your next trek with us @endif</span>
    @foreach($mq['treks'] as $mt)
     <a href="{{ $mt['url'] }}" class="hover:underline">&#9679; {{ $mt['title'] }}</a>
    @endforeach
    <a href="{{ $mq['url'] }}" class="underline">View all {{ $mq['season'] }} treks &rarr;</a>
   </div>
  @endfor
 </div>
</div>
