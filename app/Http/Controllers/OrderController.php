<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'payment_method' => 'required|string',
            'buyer_request' => 'nullable|string',
        ]);

        // Logic for storing the order
        $order = [
            'menu_id' => $validated['menu_id'],
            'payment_method' => $validated['payment_method'],
            'buyer_request' => $validated['buyer_request'],
            'created_at' => now(),
        ];

        // Simulate saving the order (replace with actual database logic)
        session()->push('order_history', $order);

        return redirect()->route('history');
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
        $menu = Menu::find($menuId);
        $menus = Menu::all();

        return view('order', [
            'menu' => $menu,
            'menus' => $menus,
        ]);
    }

    public function order()
    {
        $menus = Menu::all();
        return view('order', compact('menus'));
    }
}
