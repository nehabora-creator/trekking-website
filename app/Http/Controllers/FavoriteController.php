<?php

namespace App\Http\Controllers;

use App\Models\Trek;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Trek $trek)
    {
        $user = $request->user();
        $user->favorites()->toggle($trek->id);

        return response()->json([
            'saved' => $user->favorites()->where('treks.id', $trek->id)->exists(),
        ]);
    }
}
