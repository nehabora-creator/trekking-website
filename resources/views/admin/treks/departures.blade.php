<div class="mt-10 max-w-3xl rounded-xl bg-white shadow-sm p-6">
 <h2 class="font-display font-bold text-xl">Fixed departures for {{ $item->title }}</h2>
 <p class="text-sm text-slate-500 mt-1">These batches appear in the "Fixed Departures" box on the trek page.</p>

 <form method="POST" action="{{ route('admin.treks.departures.store', $item) }}" class="mt-4 grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">
  @csrf
  <label class="text-sm font-semibold">Start date<input type="date" name="start_date" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5"></label>
  <label class="text-sm font-semibold">Seats left<input type="number" name="seats_left" min="0" placeholder="empty = open" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5"></label>
  <label class="text-sm font-semibold">Price (Rs.)<input type="number" name="price" min="0" placeholder="trek price" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5"></label>
  <button type="submit" class="rounded-lg bg-flag text-white font-semibold px-5 py-2.5 hover:bg-black transition">Add batch</button>
 </form>

 <div class="mt-5 rounded-lg border overflow-x-auto">
  <table class="w-full text-left">
   <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Start</th><th class="px-4 py-3">End</th><th class="px-4 py-3">Seats</th><th class="px-4 py-3">Price</th><th class="px-4 py-3"></th></tr></thead>
   <tbody>
    @forelse($item->departures as $d)
     <tr class="border-t {{ $d->start_date->isPast() ? 'text-slate-400' : '' }}">
      <td class="px-4 py-3 whitespace-nowrap">{{ $d->start_date->format('D, j M Y') }}</td>
      <td class="px-4 py-3 whitespace-nowrap">{{ $d->start_date->copy()->addDays(max($item->days - 1, 0))->format('j M Y') }}</td>
      <td class="px-4 py-3">{{ $d->seats_left === null ? 'Open' : $d->seats_left }}</td>
      <td class="px-4 py-3">{{ $d->price ? number_format($d->price) : '-' }}</td>
      <td class="px-4 py-3 text-right"><form method="POST" action="{{ route('admin.departures.destroy', $d) }}" onsubmit="return confirm('Remove this batch?')">@csrf @method('DELETE')<button type="submit" class="text-slate-500 hover:text-red-600 underline">Remove</button></form></td>
     </tr>
    @empty
     <tr><td colspan="5" class="px-4 py-6 text-slate-500">No batches yet.</td></tr>
    @endforelse
   </tbody>
  </table>
 </div>
</div>
