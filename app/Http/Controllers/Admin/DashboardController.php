<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // hanya auth, tidak pakai 'admin'
    }

    public function index()
    {
        // Cek manual apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $users = User::where('role', 'user')->get();
        return view('admin.dashboard', compact('users'));
    }
}
