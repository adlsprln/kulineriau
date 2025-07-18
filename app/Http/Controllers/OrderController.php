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

    public function invoice(Order $order)
    {
        $order->load(['menu', 'user']);
        // Hanya user yang memesan atau admin yang boleh akses
        if (Auth::id() !== $order->user_id && !(Auth::check() && Auth::user()->isAdmin())) {
            abort(403);
        }
        return view('invoice', compact('order'));
    }

    public function groupInvoice($checkout_code)
    {
        $orders = \App\Models\Order::with(['menu', 'user'])
            ->where('checkout_code', $checkout_code)
            ->orderBy('created_at')
            ->get();
        if ($orders->isEmpty()) {
            abort(404);
        }
        // Hanya user pemilik atau admin yang boleh akses
        $userId = $orders->first()->user_id;
        if (auth()->id() !== $userId && !(auth()->check() && auth()->user()->isAdmin())) {
            abort(403);
        }
        return view('invoice_group', [
            'orders' => $orders,
            'checkout_code' => $checkout_code
        ]);
    }

    /**
     * Tampilkan form upload bukti pembayaran
     */
    public function showUploadPaymentForm($orderId)
    {
        $order = Order::findOrFail($orderId);
        // Hanya user pemilik order yang boleh akses
        if (Auth::id() !== $order->user_id && !(Auth::check() && Auth::user()->isAdmin())) {
            abort(403);
        }
        // Jika waktu sudah lewat dan belum upload bukti, batalkan otomatis
        if ($order->status === 'pending' && $order->payment_deadline && now()->greaterThan($order->payment_deadline) && empty($order->payment_proof)) {
            // Update semua order dengan checkout_code yang sama
            $orders = \App\Models\Order::where('checkout_code', $order->checkout_code)->get();
            foreach ($orders as $o) {
                $o->status = 'Dibatalkan';
                $o->save();
            }
            $order->refresh();
        }
        return view('order_upload_payment', compact('order'));
    }

    /**
     * Proses upload bukti pembayaran
     */
    public function uploadPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        if (Auth::id() !== $order->user_id && !(Auth::check() && Auth::user()->isAdmin())) {
            abort(403);
        }
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('payment_proof')) {
            $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $orders = \App\Models\Order::where('checkout_code', $order->checkout_code)->get();
            foreach ($orders as $o) {
                $o->payment_proof = basename($imagePath);
                $o->payment_status = 'pending';
                $o->status = 'Diproses';
                $o->save();
            }
        }
        return redirect()->route('history')->with('success', 'Bukti pembayaran berhasil diupload, menunggu verifikasi admin.');
    }

    public function print($checkout_code)
    {
        $orders = \App\Models\Order::with(['menu', 'user'])
            ->where('checkout_code', $checkout_code)
            ->get();
        if ($orders->isEmpty()) {
            abort(404);
        }
        $firstOrder = $orders->first();
        return view('print_struk', compact('orders', 'firstOrder', 'checkout_code'));
    }
}
