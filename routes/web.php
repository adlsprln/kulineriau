<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/menu', function () {
    return view('menu');
});
Route::get('/order', function () {
    return view('order');
});
Route::get('/tentangkami', function () {
    return view('tentangkami');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/history', function () {
    return view('history');
});
Route::resource('menu', MenuController::class)->middleware('auth');
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
