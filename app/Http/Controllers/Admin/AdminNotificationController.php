<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Carbon\Carbon;

class AdminNotificationController extends Controller
{
public function index()
{
    $orderMasuk = Order::with('items.product')
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($order) {
            $productNames = $order->items
                ->pluck('product.name')
                ->implode(', ');

            return [
                'icon' => 'fas fa-box',
                'message' => 'Order baru masuk: ' . $productNames,
                'time' => $order->created_at->diffForHumans(),
                'is_read' => false,
                'created_at' => $order->created_at,
            ];
        });

    $orderDone = Order::with('items.product')
        ->where('status', 'done')
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($order) {
            $productNames = $order->items
                ->pluck('product.name')
                ->implode(', ');

            return [
                'icon' => 'far fa-file-alt',
                'message' => 'Order dikonfirmasi: ' . $productNames,
                'time' => $order->updated_at->diffForHumans(),
                'is_read' => false,
                'created_at' => $order->updated_at,
            ];
        });

    $reviews = Review::with('product')
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($review) {
            return [
                'icon' => 'far fa-comment',
                'message' => 'Review ' . $review->rating . '★ untuk "' . $review->product->name . '"',
                'time' => $review->created_at->diffForHumans(),
                'is_read' => false,
                'created_at' => $review->created_at,
            ];
        });

    $notifications = collect()
        ->merge($orderMasuk)
        ->merge($orderDone)
        ->merge($reviews)
        ->sortByDesc('created_at')
        ->take(10)
        ->values();

    return view('admin.notifications', compact('notifications'));
}
}
