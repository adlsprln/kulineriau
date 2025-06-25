<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // hanya auth
    }

    public function index()
    {
        // Cek manual apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $contacts = Contact::with('user')->latest()->get();
        return view('admin.contact', compact('contacts'));
    }
}
