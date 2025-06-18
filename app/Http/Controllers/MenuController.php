<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        // Jika user login dan admin, tampilkan tabel admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return view('menu.index', compact('menus'));
        }
        // Untuk user biasa atau guest, tampilkan grid menu user
        return view('menu', compact('menus'));
    }

    public function create()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('menu.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category']);
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image_url'] = $imageName;
        }
        Menu::create($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->only(['name', 'description', 'price', 'category']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image_url'] = $imageName;
        }
        $menu->update($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy(Menu $menu)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function rate(Request $request, Menu $menu)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        // Untuk demo: rating langsung diupdate (tanpa user tracking)
        $menu->rating = $request->rating;
        $menu->save();
        return redirect()->back()->with('success', 'Terima kasih atas rating Anda!');
    }
}
