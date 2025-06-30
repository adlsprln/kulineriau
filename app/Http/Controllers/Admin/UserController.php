<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // hanya middleware auth, tidak pakai 'admin'
    }

    public function index()
    {
        // Cek manual apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        return view('admin.user', compact('users'));
    }
}
