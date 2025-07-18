<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // hanya auth
    }

    public function updateStatus(Request $request, $checkout_code)
    {
        // Cek manual apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|string',
        ]);

        // Update semua order dengan checkout_code yang sama
        $orders = Order::where('checkout_code', $checkout_code)->get();
        foreach ($orders as $order) {
            $order->status = $request->status;
            $order->save();
        }

        return back()->with('success', 'Status pesanan berhasil diupdate.');
    }
}
