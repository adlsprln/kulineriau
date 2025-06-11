<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
// Route resource menu untuk semua route CRUD (admin),
// dan route index publik agar route('menu.index') tersedia
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::resource('menu', MenuController::class)->except(['index', 'show'])->middleware('auth');

Route::get('/order', function () {
    $menus = Menu::all();
    return view('order', compact('menus'));
})->middleware('auth');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/payment', [OrderController::class, 'payment'])->name('payment.process');
Route::get('/order', [OrderController::class, 'showOrder'])->middleware('auth')->name('order');

Route::get('/tentangkami', function () {
    return view('tentangkami');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/history', function () {
    return view('history');
})->middleware('auth')->name('history');

Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
Route::get('/dashboard', function () {
    $menus = Menu::all();
    return view('dashboard', compact('menus'));
})->middleware('auth');

require __DIR__.'/auth.php';
