<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departure;
use App\Models\Trek;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function store(Request $request, Trek $trek)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'seats_left' => 'nullable|integer|min:0|max:500',
            'price' => 'nullable|integer|min:0',
        ]);

        $trek->departures()->create($data);

        return redirect()->route('admin.treks.edit', $trek)->with('success', 'Departure added.');
    }

    public function destroy(Departure $departure)
    {
        $trekId = $departure->trek_id;
        $departure->delete();

        return redirect()->route('admin.treks.edit', $trekId)->with('success', 'Departure removed.');
    }
}
