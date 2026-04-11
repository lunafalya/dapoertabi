<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Checkout;

class AdminBookingController extends Controller
{
    public function index()
{
    $bookings = Order::with(['user', 'items.product'])
        ->latest()
        ->get();

    $doneBookings = Order::where('status', 'done')->get();
    $pendingBookings = Order::where('status', 'pending')->get();

    return view('admin.booking', compact(
        'bookings',
        'doneBookings',
        'pendingBookings'
    ));
}

    public function done($id)
{
    $booking = Order::findOrFail($id);
    $booking->update(['status' => 'done']);

    return back()->with('success', 'Booking marked as done.');
}
}
