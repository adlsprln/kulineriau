<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderStatusController;

Route::get('/', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('home');
});
Route::get('/home', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('home');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::resource('menu', MenuController::class)->except(['index', 'show'])->middleware('auth');
Route::post('/menu/{menu}/rate', [MenuController::class, 'rate'])->name('menu.rate');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{menu}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/tentangkami', fn() => view('tentangkami'));
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/history', fn() => view('history'))->middleware('auth')->name('history');
Route::delete('/history/{index}', function ($index) {
    $orderHistory = session('order_history', []);
    if (isset($orderHistory[$index])) {
        unset($orderHistory[$index]);
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

Route::post('/order/{menu_id}/delete', fn($menu_id) => redirect()->route('order.delete', ['menu_id' => $menu_id]));
Route::get('/order/{order}/invoice', [OrderController::class, 'invoice'])->name('order.invoice');
Route::get('/invoice/{checkout_code}', [OrderController::class, 'groupInvoice'])->name('invoice.group');

// Route upload bukti pembayaran
Route::get('/order/{order}/upload-payment', [OrderController::class, 'showUploadPaymentForm'])->name('order.upload_payment');
Route::post('/order/{order}/upload-payment', [OrderController::class, 'uploadPayment'])->name('order.upload_payment.post');
Route::get('/order/print/{checkout_code}', [OrderController::class, 'print'])->name('order.print');

Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Manual admin check tanpa middleware khusus
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(DashboardController::class)->index();
    })->name('admin.dashboard');

    Route::get('/menu', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->index();
    })->name('admin.menu.index');

    Route::get('/menu/create', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->create();
    })->name('admin.menu.create');

    Route::post('/menu', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->store(request());
    })->name('admin.menu.store');

    Route::get('/menu/{menu}/edit', function ($menu) {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->edit($menu);
    })->name('admin.menu.edit');

    Route::put('/menu/{menu}', function ($menu) {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->update(request(), $menu);
    })->name('admin.menu.update');

    Route::delete('/menu/{menu}', function ($menu) {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminMenuController::class)->destroy($menu);
    })->name('admin.menu.destroy');

    Route::get('/order', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminOrderController::class)->index();
    })->name('admin.order.index');

    Route::post('/order/{checkout_code}/status', function ($checkout_code) {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(OrderStatusController::class)->updateStatus(request(), $checkout_code);
    })->name('admin.order.status.update');

    Route::get('/contact', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(AdminContactController::class)->index();
    })->name('admin.contact.index');

    Route::get('/user', function () {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return app(UserController::class)->index();
    })->name('admin.user.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
