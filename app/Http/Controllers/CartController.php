<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $menus = Menu::whereIn('id', array_keys($cart))->get();
        return view('cart', compact('cart', 'menus'));
    }

    public function add(Request $request, Menu $menu)
    {
        $cart = session('cart', []);
        $quantity = (int) $request->input('quantity', 1);
        if (isset($cart[$menu->id])) {
            $cart[$menu->id] += $quantity;
        } else {
            $cart[$menu->id] = $quantity;
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Menu berhasil dimasukkan ke keranjang!');
    }

    public function remove(Request $request, Menu $menu)
    {
        $cart = session('cart', []);
        unset($cart[$menu->id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Menu dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        $selectedMenus = $request->input('selected_menus', []);
        $quantities = $request->input('quantities', []);
        if (empty($cart) || empty($selectedMenus)) {
            return back()->with('error', 'Pilih menu yang ingin dipesan.');
        }
        $user = Auth::user();
        $checkoutCode = 'INV' . now()->format('YmdHis') . $user->id . rand(100,999);
        // Set payment_deadline 30 menit dari sekarang
        $paymentDeadline = now()->addMinutes(30);
        foreach ($selectedMenus as $menu_id) {
            if (isset($cart[$menu_id])) {
                $qty = isset($quantities[$menu_id]) ? max(1, (int)$quantities[$menu_id]) : $cart[$menu_id];
                Order::create([
                    'user_id' => $user->id,
                    'menu_id' => $menu_id,
                    'quantity' => $qty,
                    'payment_method' => $request->input('payment_method', 'bank_transfer'),
                    'buyer_request' => $request->input('buyer_request', null),
                    'checkout_code' => $checkoutCode,
                    'payment_deadline' => $paymentDeadline,
                ]);
                unset($cart[$menu_id]);
            }
        }
        session(['cart' => $cart]);
        // Ambil order pertama dari group checkout_code
        $firstOrder = Order::where('checkout_code', $checkoutCode)->first();
        if ($firstOrder) {
            return redirect()->route('order.upload_payment', $firstOrder->id);
        }
        return redirect()->route('history')->with('error', 'Terjadi kesalahan saat checkout.');
    }
}
