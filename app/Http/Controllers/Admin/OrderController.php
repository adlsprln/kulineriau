<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // hanya auth, tanpa 'admin'
    }

    public function index()
    {
        // Cek manual apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $orders = Order::with(['menu', 'user'])->latest()->get();
        return view('admin.order', compact('orders'));
    }
}
