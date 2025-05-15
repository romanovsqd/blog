<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->name = $data['name'];

        if ($request->filled('password')) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return redirect()->back();
    }
}
