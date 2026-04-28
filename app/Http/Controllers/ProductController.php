<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($query, $search) {
        $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('products', compact('products'));
    }

    public function home()
    {
        $products = Product::latest()->take(8)->get(); // buat homepage
        return view('welcome', compact('products'));
    }

    public function show($id)
{
    $product = Product::with('reviews.user')->findOrFail($id);

    return view('detail', compact('product'));
}

    
}
