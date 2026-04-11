<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class AdminReviewController extends Controller
{
    public function index()
{
    $reviews = Review::with(['user', 'product'])
        ->latest()
        ->get();

    $averageRating = round($reviews->avg('rating') ?? 0, 2);
    $totalReviews = $reviews->count();

    // rating bar (1–5)
    $ratingBars = [];
    for ($i = 5; $i >= 1; $i--) {
        $count = $reviews->where('rating', $i)->count();
        $ratingBars["{$i} Stars"] = $totalReviews > 0
            ? round(($count / $totalReviews) * 100)
            : 0;
    }

    // dummy weekly chart (opsional)
    $weeklyChart = [
        'Mon' => 40,
        'Tue' => 55,
        'Wed' => 70,
        'Thu' => 30,
        'Fri' => 60,
        'Sat' => 80,
        'Sun' => 50,
    ];

    return view('admin.review', compact(
        'reviews',
        'averageRating',
        'totalReviews',
        'ratingBars',
        'weeklyChart'
    ));
}
}
