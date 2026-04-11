<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use App\Models\Checkout;

class ReviewController extends Controller
{
    public function create(Checkout $checkout)
    {
        if (!$checkout->order || $checkout->order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('review', compact('checkout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('history')
            ->with('success', 'Review added!');
    }

    
}
