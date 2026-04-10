<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminProductController;

/// USERS ROUTES
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class,'register'])->name('register');

Route::get('/', function(){
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');

    Route::get('/review/{product}', [ReviewController::class,'create'])->name('review.create');
Route::post('/review', [ReviewController::class,'store'])->name('review.store');
});



/// ADMIN ROUTES

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/profile', [AdminProfileController::class,'show'])
        ->name('admin.profile');

    Route::post('/admin/profile', [AdminProfileController::class,'update'])
        ->name('admin.profile.update');

    Route::get('/admin/products', [AdminProductController::class,'index'])
        ->name('admin.products');

    Route::post('/admin/products/add', [AdminProductController::class,'store'])
        ->name('admin.products.store');

    Route::put('/admin/products/{id}', [AdminProductController::class,'update'])
    ->name('admin.products.update');

    Route::delete('/admin/products/{id}', [AdminProductController::class,'destroy'])
        ->name('admin.products.destroy');

    Route::get('/admin/messages', function () { return view('admin.message'); })->name('admin.messages');
    Route::get('/admin/notifications', function () { return view('admin.notifications'); })->name('admin.notifications');
    Route::get('/admin/bookings', function () { return view('admin.booking'); })->name('admin.bookings');
    Route::get('/admin/reviews', function () { return view('admin.review'); })->name('admin.reviews');
    Route::get('/admin/pdf', function () { return view('admin.pdf'); })->name('admin.pdf');

});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/contactus', function () {
    return view('contactus');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/review', function () {
    return view('review');
});

?>

