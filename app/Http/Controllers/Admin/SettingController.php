<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /** key => label */
    private function keys(): array
    {
        return [
            'site_name' => 'Site name',
            'phone' => 'Phone number',
            'email' => 'Email',
            'address' => 'Address',
            'hours' => 'Open hours',
            'whatsapp' => 'WhatsApp number (digits only, with country code)',
            'footer_note' => 'Footer note',
        ];
    }

    public function edit()
    {
        return view('admin.settings.edit', ['keys' => $this->keys()]);
    }

    public function update(Request $request)
    {
        $rules = [];
        foreach (array_keys($this->keys()) as $key) {
            $rules[$key] = 'nullable|string|max:300';
        }
        $data = $request->validate($rules);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Settings saved.');
    }
}
