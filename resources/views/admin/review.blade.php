@extends('layouts.admin')

@php
    $user = Auth::user();

    // Dummy Data for Statistics
    $averageRating = 4.95;
    $totalReviews = 187;
    
    // Width percentages for the progress bars to match the image visually
    $ratingBars = [
        '5 Star' => 95,
        '4 Star' => 80,
        '3 Star' => 60,
        '2 Star' => 25,
        '1 Star' => 15,
    ];

    // Dummy Data for the Chart (Heights in percentage)
    $weeklyChart = [
        'M' => 20, 'T' => 40, 'W' => 60, 'T' => 80, 'F' => 100, 'S' => 85, 'S' => 85
    ];

    // Dummy Data for Reviews
    $reviews = [
        (object)[
            'service_name' => 'Bread',
            'customer_name' => 'John',
            'rating' => 5,
            'review_text' => 'Great product! Really loved the quality and fast delivery.',
            'image' => 'images/default-avatar.png' // Or whatever default image you have
        ],
        (object)[
            'service_name' => 'Donut',
            'customer_name' => 'John',
            'rating' => 5,
            'review_text' => 'Great product! Really loved the quality and fast delivery.',
            'image' => 'images/default-avatar.png'
        ],
        (object)[
            'service_name' => 'Cookies',
            'customer_name' => 'John',
            'rating' => 5,
            'review_text' => 'Great product! Really loved the quality and fast delivery.',
            'image' => 'images/default-avatar.png'
        ]
    ];
@endphp

@section('content')

<style>
    /* Typography */
    .heading-serif {
        font-family: 'Abhaya Libre', serif;
        color: #5C4334;
        font-weight: 700;
    }
    .text-brown { color: #5C4334; }
    .text-light-brown { color: #A69485; }
    .star-color { color: #E5C17C; }

    /* Top Stats Cards */
    .stats-card {
        background-color: #EADFC8; /* Solid tan background */
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        padding: 24px;
        height: 100%;
    }

    /* Custom Rating Progress Bars */
    .rating-bar-container {
        height: 8px;
        background-color: #DBC5A0; /* Light tan background */
        border-radius: 10px;
        width: 100px;
        overflow: hidden;
    }
    .rating-bar-fill {
        height: 100%;
        background-color: #E5C17C; /* Gold fill */
        border-radius: 10px;
    }

    /* Weekly Chart */
    .chart-bar-container {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        height: 80px;
        gap: 8px;
    }
    .chart-bar {
        width: 6px;
        background-color: #E5C17C; /* Gold bars */
        border-radius: 10px;
    }

    /* Main White Card */
    .main-white-card {
        background-color: #FFFCF8;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        padding: 30px;
    }

    /* Buttons */
    .btn-pill {
        border-radius: 50px;
        padding: 4px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        color: #FFFFFF;
        transition: opacity 0.2s;
    }
    .btn-pill:hover { opacity: 0.9; color: #FFFFFF; }
    .btn-export { background-color: #E5C17C; color: #FFFFFF; padding: 6px 20px;}
    .btn-detail { background-color: #8B6A4B; }
    .btn-delete { background-color: #D32F2F; }

    /* Review Items */
    .review-item {
        background-color: #FDF6E3; /* Light tan inner background */
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
</style>

<div class="container-fluid px-0">
    
    <div class="row mb-4 g-4">
        
        <div class="col-lg-6">
            <div class="stats-card d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-center">
                    
                    <div class="pe-4">
                        <h5 class="text-brown fw-bold mb-3">Users Rating</h5>
                        <h1 class="display-4 fw-bold text-brown mb-0" style="line-height: 1;">{{ $averageRating }}</h1>
                        <div class="star-color mb-1" style="font-size: 1.1rem;">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <small class="text-brown fw-medium">Total {{ $totalReviews }} reviews</small>
                    </div>
                    
                    <div class="flex-grow-1 ps-3 border-start border-light" style="border-color: rgba(139, 106, 75, 0.2) !important;">
                        @foreach ($ratingBars as $label => $width)
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <span class="text-brown fw-medium me-2" style="font-size: 0.9rem;">{{ $label }}</span>
                                <div class="rating-bar-container">
                                    <div class="rating-bar-fill" style="width: {{ $width }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="stats-card d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between h-100">
                    
                    <div class="d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="text-brown fw-bold mb-1">Reviews Statistics</h5>
                            <p class="text-brown mb-2" style="font-size: 0.9rem;">12 New Reviews</p>
                            <span class="badge" style="background-color: #5C4334; color: #FFF; border-radius: 6px;">+8,5 %</span>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-brown fw-bold mb-0">87% Positive Reviews</h6>
                            <small class="text-brown opacity-75">Weekly Report</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-end" style="gap: 12px; padding-bottom: 5px;">
                        @foreach($weeklyChart as $day => $height)
                            <div class="chart-bar-container">
                                <div class="chart-bar" style="height: {{ $height }}%;"></div>
                                <small class="text-brown fw-bold" style="font-size: 0.75rem;">{{ $day }}</small>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="main-white-card">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-brown fw-bold mb-0">Manage Rating and Reviews</h4>
            <div class="d-flex align-items-center gap-4">
                <span class="text-brown fw-medium">10</span>
                <span class="text-brown fw-medium">All</span>
                <button class="btn-pill btn-export shadow-sm">Export</button>
            </div>
        </div>
        
        <div>
            @foreach ($reviews as $review)
                <div class="review-item">
                    
                    <div class="d-flex gap-3">
                        <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; background-color: #3E2723; flex-shrink: 0;">
                            <img src="{{ asset($review->image) }}" alt="Customer" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                        </div>
                        
                        <div>
                            <h6 class="text-brown fw-bold mb-1">{{ $review->service_name }}</h6>
                            <div class="text-light-brown mb-1" style="font-size: 0.85rem;">
                                <span class="fw-bold text-brown">Customer</span> :{{ $review->customer_name }}
                            </div>
                            <div class="star-color mb-1" style="font-size: 0.8rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted opacity-25' }}"></i>
                                @endfor
                            </div>
                            <div class="text-light-brown" style="font-size: 0.85rem;">
                                <span class="fw-bold text-brown">Review</span> &nbsp;&nbsp;:{{ $review->review_text }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 ms-3">
                        <button class="btn-pill btn-detail">Detail</button>
                        <button class="btn-pill btn-delete">Hapus</button>
                    </div>
                    
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection