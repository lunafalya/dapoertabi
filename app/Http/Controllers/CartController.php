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

        public function add(Request $request, $id)
    {
        // ambil produk dari database
        $product = Product::findOrFail($id);

        // ambil qty, default 1
        $qty = max(1, (int) $request->quantity);

        $cart = session()->get('cart', []);
        $productId = (string) $product->id;

        if (isset($cart[$productId])) {
            // tambah qty, bukan replace
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->file_path,
                'qty'   => $qty
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
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
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->back();
        }

        // kalau user ketik manual
        if ($request->filled('quantity')) {
            $qty = max(1, (int) $request->quantity);
        } else {
            $qty = $cart[$id]['qty'];
        }

        // kalau klik tombol
        if ($request->action === 'increase') {
            $qty++;
        } elseif ($request->action === 'decrease') {
            $qty = max(1, $qty - 1);
        }

        $cart[$id]['qty'] = $qty;
        session()->put('cart', $cart);

        return redirect()->back();
    }
}
