<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        return view('admin.enquiries.index', [
            'items' => Enquiry::with('trek')->latest()->paginate(20),
        ]);
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['trek', 'user']);

        return view('admin.enquiries.show', ['item' => $enquiry]);
    }

    public function update(Enquiry $enquiry)
    {
        $enquiry->update(['status' => $enquiry->status === 'new' ? 'done' : 'new']);

        return back()->with('success', 'Status changed.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')->with('success', 'Deleted.');
    }
}
