<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Checkout;

class CartController extends Controller
{
   public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    $productId = (string)$product->id;

    if(isset($cart[$productId])) {
        $cart[$productId]['qty'] += 1;
    } else {
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->file_path,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index');
}

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        $cart[$id]['qty'] = max(1, $request->qty);
        session()->put('cart', $cart);
    }

    return redirect()->back();
}
}
