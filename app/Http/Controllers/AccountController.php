<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('account.index', [
            'user' => $user,
            'favorites' => $user->favorites()->with(['region', 'images'])->get(),
            'enquiries' => $user->enquiries()->with('trek')->latest()->get(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            if (empty($data['current_password']) || ! Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Your current password is not correct.']);
            }
            $user->password = $data['password'];
        }

        $user->save();

        return back()->with('success', 'Your profile is updated.');
    }
}
