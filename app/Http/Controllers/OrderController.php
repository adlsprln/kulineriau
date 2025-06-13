<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'buyer_request' => 'nullable|string',
        ]);

        // Simpan order ke database
        $order = Order::create([
            'user_id' => Auth::id(),
            'menu_id' => $validated['menu_id'],
            'quantity' => $validated['quantity'],
            'payment_method' => $validated['payment_method'],
            'buyer_request' => $validated['buyer_request'] ?? null,
        ]);

        return redirect()->route('history')->with('success', 'Pesanan berhasil disimpan!');
    }

    public function payment(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
        ]);

        // Logic for storing the order can be added here

        return redirect()->route('history');
    }

    public function showOrder(Request $request)
    {
        $menuId = $request->query('menu_id');
        $menu = null;
        $menus = collect();
        if ($menuId) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $menus = collect([$menu]);
            }
        }
        return view('order', [
            'menu' => $menu,
            'menus' => $menus,
        ]);
    }

    public function order()
    {
        // Default: tidak tampilkan menu apapun jika tidak dipilih dari menu
        $menus = collect();
        return view('order', compact('menus'));
    }
}
