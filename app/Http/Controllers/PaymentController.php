<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;

class PaymentController extends Controller
{

public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Generate Snap Token & show payment page
     */
    public function process(Order $order)
    {
        if ($order->payment_method !== 'cashless') {
            abort(404);
        }

        if ($order->status === 'done') {
            return redirect()->route('history');
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone ?? '',
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'name' => $item->product->name,
                ];
            })->toArray(),
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment', compact('order', 'snapToken'));
    }

    /**
     * Callback dari Midtrans
     */
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            abort(403);
        }

        $orderId = str_replace('ORDER-', '', $request->order_id);
        $order = Order::findOrFail($orderId);

        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            $order->update(['status' => 'done']);
            session()->forget('cart');
        }

        if (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'ok']);
    }
// public function pay(Order $order)
// {
//     Config::$serverKey = config('services.midtrans.server_key');
//     Config::$isProduction = false;
//     Config::$isSanitized = true;
//     Config::$is3ds = true;

//     $params = [
//         'transaction_details' => [
//             'order_id' => 'ORDER-' . $order->id,
//             'gross_amount' => $order->total,
//         ],
//         'customer_details' => [
//             'first_name' => $order->user->name,
//             'email' => $order->user->email,
//         ],
//     ];

//     $snapToken = Snap::getSnapToken($params);

//     return view('payment.pay', compact('snapToken', 'order'));
// }
}
