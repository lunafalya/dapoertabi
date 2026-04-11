@php
    $user = Auth::user();
@endphp

@extends('layouts.admin')

@section('content')

<style>
    /* Custom Color Palette and Fonts to match Figma */
    :root {
        --primary-brown: #5C4334;
        --light-tan: #EADFC8;
        --card-bg: #FFFCF8;
        --text-muted: #A69485;
        --chart-line: #4662E5;
        --border-color: #EFEBE1;
    }

    .serif-heading {
        font-family: 'Playfair Display', 'Times New Roman', serif;
        color: var(--primary-brown);
    }

    .text-brown {
        color: var(--primary-brown);
    }

    .text-tan-muted {
        color: var(--text-muted);
    }

    .card-custom {
        background-color: var(--card-bg);
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }

    /* Welcome Banner Specific */
    .welcome-banner {
        background-color: var(--light-tan);
        border-radius: 16px;
        padding: 2rem;
    }

    /* Icon styling for stats */
    .stat-icon-wrapper {
        background-color: #F4EFE6;
        border-radius: 8px;
        padding: 10px;
        color: var(--primary-brown);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Table styling */
    .table-custom {
        --bs-table-bg: transparent;
        color: var(--primary-brown);
    }
    .table-custom thead th {
        color: var(--text-muted);
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1rem;
    }
    .table-custom tbody td {
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 0.5rem;
        vertical-align: middle;
    }
    
    /* Custom Scrollbar for tables */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #F4EFE6; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #D5C6A7; 
        border-radius: 10px;
    }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="welcome-banner">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="serif-heading fw-bold mb-3">Welcome {{ $user->name ?? 'John' }}!</h1>
                    <p class="text-tan-muted mb-2">| Manage your orders and customer's feedback efficiently.</p>
                    <p class="text-tan-muted mb-0">| Stay updated with real-time notifications and insights.</p>
                </div>
                
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="card-custom p-3" style="height: 220px;">
                        <canvas id="salesChart" style="max-height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex flex-column mb-2">
                <div class="mb-3"> 
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-cart-plus fa-lg"></i> 
                    </div>
                </div>
                <p class="mb-1 text-tan-muted fw-medium">Today's Order</p>
                <h3 class="fw-bold text-brown mb-0">{{ $totalOrders ?? '115' }}</h3>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex flex-column mb-2">
                <div class="mb-3">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-shopping-bag fa-lg"></i> 
                    </div>
                </div>
                <p class="mb-1 text-tan-muted fw-medium">Today's Income</p>
                <h3 class="fw-bold text-brown mb-0">Rp {{ isset($totalUang) ? number_format($totalUang, 0, ',', '.') : '50000' }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom mb-4 overflow-hidden">
    <h5 class="pt-4 px-4 serif-heading fw-bold mb-4">RECENT ORDERS</h5>
    <div class="px-4 pb-4 overflow-auto custom-scrollbar" style="max-height: 300px;">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ORDER NO</th>
                    <th>CUSTOMER NAME</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $index => $booking)
                    <tr>
                        <td class="text-tan-muted">{{ $index + 1 }}</td>
                        <td class="text-brown">{{ $booking->id }}</td>
                        <td class="text-brown">{{ $booking->user->name ?? ($booking->user->email ?? 'Guest') }}</td>
                        <td>
                            @if ($booking->status == 'pending')
                                <span class="text-warning fw-bold">Pending</span>
                            @elseif ($booking->status == 'done')
                                <span class="text-success fw-bold">Done</span>
                            @else
                                <span class="text-secondary fw-bold">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                        <td class="text-tan-muted">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-tan-muted py-4">No recent orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card card-custom mb-5 overflow-hidden">
    <h5 class="pt-4 px-4 serif-heading fw-bold mb-4">NOTIFICATIONS</h5> 
    <div class="px-4 pb-4 overflow-auto custom-scrollbar" style="max-height: 300px;">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Message</th>
                    <th>Last Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $index => $notification)
                    <tr>
                        <td class="text-tan-muted">{{ $index + 1 }}</td>
                        <td class="text-brown">
                            @if ($notification['type'] === 'booking')
                                <i class="fas fa-box me-2 text-tan-muted"></i>
                            @else
                                <i class="fas fa-comment-dots me-2 text-tan-muted"></i>
                            @endif
                            {{ $notification['message'] }}
                        </td>
                        <td class="text-tan-muted">{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-tan-muted py-4">No notifications yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart');

        // Adjusted to match Figma design labels (Apr - Dec)
        const months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // Dummy data reflecting the bar heights in the image
        const barData = [100, 150, 250, 180, 280, 240, 480, 260, 490];
        
        // Dummy data reflecting the blue trend line in the image
        const lineData = [100, 180, 120, 220, 310, 300, 330, 210, 320];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Orders',
                        data: barData,
                        backgroundColor: '#5C4334', // Dark brown bars
                        borderRadius: 4, // slight rounding on top of bars
                        barThickness: 6, // narrow bars like in the image
                        yAxisID: 'y'
                    },
                    {
                        label: 'Revenue Trend',
                        data: lineData,
                        type: 'line',
                        borderColor: '#4662E5', // Bright blue line
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        borderWidth: 2,
                        tension: 0.4, // smooth curves
                        pointRadius: 3, // tiny points
                        pointBackgroundColor: '#4662E5',
                        yAxisID: 'y' // Sharing the same axis visually
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#A69485' }
                    },
                    y: { 
                        beginAtZero: true,
                        max: 500, // Matching the max value on Figma
                        grid: {
                            color: '#EFEBE1', 
                            borderDash: [5, 5] 
                        },
                        ticks: { 
                            stepSize: 100,
                            color: '#A69485' 
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            }
        });
    });
</script>

@endsection