<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
{
    $orderId = str_replace('ORDER-', '', $request->order_id);
    $order = Order::findOrFail($orderId);

    if ($request->transaction_status === 'settlement') {
        $order->update(['status' => 'done']);
    }

    return response()->json(['status' => 'ok']);
}
}
