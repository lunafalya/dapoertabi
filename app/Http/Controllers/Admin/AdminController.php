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
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

public function index()
{
    $user = Auth::user();

    $year = now()->year;

    // Ambil order selesai (atau pending+done sesuai kebutuhanmu)
    $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_orders')
        )
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total_orders', 'month');

    $monthlyRevenue = Order::with('items')
        ->whereYear('created_at', $year)
        ->get()
        ->groupBy(function ($order) {
            return $order->created_at->month;
        })
        ->map(function ($orders) {
            return $orders->sum(function ($order) {
                return $order->items->sum(function ($item) {
                    return $item->price * $item->qty;
                });
            });
        });
        
    // Recent Orders
    $bookings = Order::with(['user', 'items.product'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Total order
    $totalOrders = $bookings->count();
    $labels = [];
    $orderData = [];
    $revenueData = [];

    for ($m = 1; $m <= 12; $m++) {
        $labels[] = Carbon::create()->month($m)->format('M');
        $orderData[] = $monthlyOrders[$m] ?? 0;
        $revenueData[] = (int) ($monthlyRevenue[$m] ?? 0);
    }

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
        'notifications',
        'labels',
        'orderData',
        'revenueData'
    ));
}
}
