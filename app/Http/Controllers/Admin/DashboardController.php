<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Review;
use App\Models\Trek;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'Treks' => Trek::count(),
                'Users' => User::count(),
                'Reviews' => Review::count(),
                'New enquiries' => Enquiry::where('status', 'new')->count(),
            ],
            'latest' => Enquiry::with('trek')->latest()->take(8)->get(),
        ]);
    }
}
