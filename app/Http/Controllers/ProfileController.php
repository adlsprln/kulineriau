<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'nullable',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'city' => 'nullable',
            'postal_code' => 'nullable',
        ]);
        $user->update($data);
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
