<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Checkout;

class OrderController extends Controller
{

public function index()
{
    $cart = session()->get('cart', []);
    $user = auth()->user();

    return view('checkout', compact('cart','user'));
}

public function store(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart kosong');
    }

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // status beda berdasarkan payment
    $status = $request->payment == 'cashless'
        ? 'pending_payment'
        : 'pending';

    $order = Order::create([
        'user_id' => auth()->id(),
        'urban_village' => $request->urban_village,
        'address' => $request->address,
        'notes' => $request->notes,
        'payment_method' => $request->payment,
        'total' => $total,
        'status' => $status
    ]);

    foreach ($cart as $id => $item) {
        $order->items()->create([
            'product_id' => $id,
            'qty' => $item['qty'],
            'price' => $item['price']
        ]);
    }

    // jika cashless masuk ke halaman payment QR
    if ($request->payment == 'cashless') {
        return redirect()->route('payment.show', $order->id);
    }

    // cash
    session()->forget('cart');

    return redirect()
        ->route('history')
        ->with('success', 'Pesanan berhasil dibuat. Silakan bayar di tempat.');
}
//     public function store(Request $request)
// {
//     $request->validate([
//         'payment' => 'required|in:cash,cashless',
//     ]);

//     $cart = session('cart', []);

//     $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

//     $order = Order::create([
//         'user_id' => auth()->id(),
//         'urban_village' => $request->urban_village,
//         'address' => $request->address,
//         'notes' => $request->notes,
//         'payment_method' => $request->payment,
//         'total' => $total,
//         'status' => 'pending',
//     ]);

//     // simpan item checkout
//     foreach ($cart as $item) {
//         Checkout::create([
//             'order_id' => $order->id,
//             'product_id' => $item['id'],
//             'qty' => $item['qty'],
//             'price' => $item['price'],
//         ]);
//     }

//     session()->forget('cart');

//     // ===== CASHLESS =====
//     if ($request->payment === 'cashless') {

//         Config::$serverKey = config('services.midtrans.server_key');
//         Config::$isProduction = false;
//         Config::$isSanitized = true;
//         Config::$is3ds = true;

//         $params = [
//             'transaction_details' => [
//                 'order_id' => 'ORDER-' . $order->id,
//                 'gross_amount' => $order->total,
//             ],
//             'customer_details' => [
//                 'first_name' => auth()->user()->name,
//                 'email' => auth()->user()->email,
//             ],
//         ];

//         $snapToken = Snap::getSnapToken($params);

//         return view('checkout.payment', compact('snapToken', 'order'));
//     }

//     // ===== CASH =====
//     return redirect()
//         ->route('history')
//         ->with('success', 'Pesanan berhasil dibuat. Menunggu konfirmasi admin.');
// }
}
