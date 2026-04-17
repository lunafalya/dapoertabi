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
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Product;

/// USERS ROUTES
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class,'register'])->name('register');

Route::get('/', function(){
    $products = Product::latest()->take(8)->get();; 
    return view('welcome', compact('products'));
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
    Route::get('/checkout/success', [OrderController::class, 'success'])->name('checkout.success');

    Route::get('/history', [ProfileController::class, 'index'])->name('history');

    Route::get('/review/{checkout}', [ReviewController::class,'create'])->name('review.create');
    Route::post('/review', [ReviewController::class,'store'])->name('review.store');

    
});



/// ADMIN ROUTES

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

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

    Route::get('admin/booking', [AdminBookingController::class, 'index'])
        ->name('admin.booking');

    Route::patch('/admin/booking/{order}/status', [AdminBookingController::class, 'updateStatus'])
        ->name('admin.booking.updateStatus');

    Route::post('/admin/booking/{order}/done', [AdminBookingController::class, 'done']
        )->name('admin.booking.done');

    Route::get('/admin/messages', function () { return view('admin.message'); })->name('admin.messages');
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');

    Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews');
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

?>
