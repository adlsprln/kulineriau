<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    // Tidak perlu constructor lagi karena kita akan cek manual di tiap method

    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $menus = Menu::all();
        $users = \App\Models\User::where('role', 'user')->get();
        return view('admin.menu', compact('menus', 'users'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return view('admin.menu_create');
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image_url'] = $imageName;
        }

        Menu::create($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $menu = Menu::findOrFail($id);
        return view('admin.menu_edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $menu = Menu::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image_url'] = $imageName;
        }

        $menu->update($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $menu = Menu::findOrFail($id);
        if ($menu->image_url && file_exists(public_path('images/'.$menu->image_url))) {
            unlink(public_path('images/'.$menu->image_url));
        }
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
    
}


