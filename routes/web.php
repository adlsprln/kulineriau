<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

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

Route::post('/menu/{menu}/rate', [App\Http\Controllers\MenuController::class, 'rate'])->name('menu.rate');

// Route keranjang (cart)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{menu}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/tentangkami', function () {
    return view('tentangkami');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/history', function () {
    return view('history');
})->middleware('auth')->name('history');
Route::delete('/history/{index}', function ($index) {
    $orderHistory = session('order_history', []);
    if (isset($orderHistory[$index])) {
        unset($orderHistory[$index]);
        // Reindex array agar tidak ada index yang hilang
        $orderHistory = array_values($orderHistory);
        session(['order_history' => $orderHistory]);
    }
    return redirect()->route('history')->with('success', 'Pesanan berhasil dibatalkan/dihapus.');
})->name('history.delete');
Route::match(['get', 'post', 'delete'], '/order/{menu_id}', function ($menu_id) {
    $orderHistory = session('order_history', []);
    foreach ($orderHistory as $i => $order) {
        if ($order['menu_id'] == $menu_id) {
            unset($orderHistory[$i]);
            break;
        }
    }
    $orderHistory = array_values($orderHistory);
    session(['order_history' => $orderHistory]);
    return back()->with('success', 'Pesanan berhasil dihapus.');
})->name('order.delete');
Route::post('/order/{menu_id}/delete', function ($menu_id) {
    $orderHistory = session('order_history', []);
    foreach ($orderHistory as $i => $order) {
        if ($order['menu_id'] == $menu_id) {
            unset($orderHistory[$i]);
            break;
        }
    }
    $orderHistory = array_values($orderHistory);
    session(['order_history' => $orderHistory]);
    return back()->with('success', 'Pesanan berhasil dihapus.');
})->name('order.delete');

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
