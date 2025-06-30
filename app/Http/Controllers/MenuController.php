<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        // Hanya untuk user/guest
        return view('menu', compact('menus'));
    }

    public function rate(Request $request, Menu $menu)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $menu->rating = $request->rating;
        $menu->save();
        return redirect()->back()->with('success', 'Terima kasih atas rating Anda!');
    }
}
