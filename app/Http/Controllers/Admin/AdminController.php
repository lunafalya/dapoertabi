<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{

public function index()
{
    $user = Auth::user();

    // Recent Orders
    $bookings = Order::with(['user', 'items.product'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Total order
    $totalOrders = $bookings->count();

    // Total income
    $totalUang = 0;
    foreach ($bookings as $booking) {
        foreach ($booking->items as $item) {
            $totalUang += $item->price * $item->qty;
        }
    }

    $orderNotifications = Order::with('items.product')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get()
        ->map(function ($order) {
            return [
                'type' => 'booking',
                'message' => 'Order masuk #' . $order->id,
                'created_at' => $order->created_at,
            ];
        });

    // Review notifications
    $reviewNotifications = Review::with('product')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get()
        ->map(function ($review) {
            return [
                'type' => 'review',
                'message' => 'Review bintang ' . $review->rating .
                             ' untuk "' . ($review->product->name ?? '-') . '"',
                'created_at' => $review->created_at,
            ];
        });

    $notifications = $orderNotifications
        ->merge($reviewNotifications)
        ->sortByDesc('created_at')
        ->take(3);

    return view('admin.dashboard', compact(
        'user',
        'bookings',
        'totalOrders',
        'totalUang',
        'notifications'
    ));
}
}
