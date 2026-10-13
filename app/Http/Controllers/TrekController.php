<?php

namespace App\Http\Controllers;

use App\Models\Trek;
use Illuminate\Http\Request;

class TrekController extends Controller
{
    public function show(Request $request, Trek $trek)
    {
        abort_unless($trek->is_published, 404);

        $trek->load(['region', 'images']);

        // Departures from today onwards, grouped by month for the next 12 months.
        $upcoming = $trek->departures()
            ->whereDate('start_date', '>=', now()->toDateString())
            ->get();

        $months = [];
        $startMonth = now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $m = $startMonth->copy()->addMonths($i);
            $months[] = [
                'label' => $m->format('F-Y'),
                'items' => $upcoming->filter(fn ($d) => $d->start_date->isSameMonth($m))->values(),
            ];
        }

        // Similar treks: same region first, then the rest.
        $others = Trek::published()
            ->with(['region', 'images'])
            ->where('id', '!=', $trek->id)
            ->orderBy('sort_order')
            ->get();
        $similar = $others->where('region_id', $trek->region_id)
            ->merge($others->where('region_id', '!=', $trek->region_id))
            ->take(4)
            ->values();

        return view('treks.show', [
            'trek' => $trek,
            'months' => $months,
            'similar' => $similar,
        ]);
    }
}
