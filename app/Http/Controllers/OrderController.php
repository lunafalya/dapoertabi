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

        if(empty($cart)){
            return redirect()->back()->with('error','Cart kosong');
        }

        $total = 0;
        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'urban_village' => $request->urban_village,
            'address' => $request->address,
            'notes' => $request->notes,
            'payment_method' => $request->payment,
            'total' => $total
        ]);

        foreach ($cart as $id => $item) {
            $order->items()->create([
                'product_id' => $id,
                'qty' => $item['qty'],
                'price' => $item['price']
            ]);
        }

        // kosongkan cart
        session()->forget('cart');

        return redirect()->route('cart.index')
            ->with('success','Order berhasil dibuat');
    }
}
