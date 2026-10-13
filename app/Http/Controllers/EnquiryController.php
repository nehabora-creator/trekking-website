<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Trek;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        // Hidden "website" field is a trap for spam bots.
        if ($request->filled('website')) {
            return redirect(route('home').'#contact')->with('success', 'Thank you!');
        }

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'phone' => 'nullable|string|max:40',
            'trek' => 'nullable|string|max:150',
            'topic' => 'nullable|string|max:60',
            'month' => 'nullable|string|max:20',
            'group_size' => 'nullable|string|max:40',
            'batch' => 'nullable|string|max:80',
            'message' => 'nullable|string|max:3000',
        ]);

        $trek = ! empty($data['trek']) ? Trek::where('slug', $data['trek'])->first() : null;

        Enquiry::create([
            'user_id' => $request->user()?->id,
            'trek_id' => $trek?->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'topic' => $data['topic'] ?? null,
            'month' => $data['month'] ?? null,
            'group_size' => $data['group_size'] ?? null,
            'batch' => $data['batch'] ?? null,
            'message' => $data['message'] ?? null,
        ]);

        return redirect(route('home').'#contact')
            ->with('success', 'Thanks '.$data['name'].'! Your enquiry is received. We will reply soon.');
    }
}
