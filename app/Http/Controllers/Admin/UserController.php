<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'items' => User::latest()->paginate(30),
        ]);
    }

    public function toggleAdmin(Request $request, User $user)
    {
        if ($request->user()->id === $user->id) {
            return back()->withErrors(['user' => 'You cannot change your own admin access.']);
        }

        $user->update(['is_admin' => ! $user->is_admin]);

        return back()->with('success', 'Access updated.');
    }
}
