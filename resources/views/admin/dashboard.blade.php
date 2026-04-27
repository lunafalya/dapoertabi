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

    .text-brown { color: var(--primary-brown); }
    .text-tan-muted { color: var(--text-muted); }

    .card-custom {
        background-color: var(--card-bg);
        border: none;
        border-radius: 16px; /* Slightly rounder for a modern feel */
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    /* Sleek Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, var(--light-tan) 0%, #F4EFE6 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        border-left: 6px solid var(--primary-brown);
    }

    /* Icon styling for stats */
    .stat-icon-wrapper {
        background-color: var(--light-tan);
        border-radius: 12px;
        padding: 14px;
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
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 1rem;
        letter-spacing: 0.5px;
    }
    .table-custom tbody td {
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 0.5rem;
        vertical-align: middle;
        font-size: 0.95rem;
    }
    
    /* Custom Scrollbar for tables */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #F4EFE6; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #DBC5A0; border-radius: 10px; }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="welcome-banner d-flex justify-content-between align-items-center">
            <div>
                <h2 class="serif-heading fw-bold mb-1">Welcome back, {{ $user->name ?? 'Admin' }}!</h2>
                <p class="text-tan-muted mb-0">Here is what's happening with your store today.</p>
            </div>
            <div class="d-none d-md-block text-end">
                <p class="text-tan-muted mb-0 fw-medium">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">

    <div class="col-lg-8">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="serif-heading fw-bold mb-0">REVENUE OVERVIEW</h5>
                <span class="badge bg-light text-brown border">This Year</span>
            </div>
            <div style="height: 280px; width: 100%;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

  <div class="col-lg-4 d-flex flex-column gap-4">
        
        <div class="card card-custom p-4 flex-grow-1 d-flex justify-content-center">
            <div class="d-flex align-items-center gap-4">
                <div class="stat-icon-wrapper">
                    <i class="fas fa-cart-plus fa-2x"></i> 
                </div>
                <div>
                    <p class="mb-1 text-tan-muted fw-medium text-uppercase" style="font-size: 0.8rem;">Today's Orders</p>
                    <h2 class="fw-bold text-brown mb-0">{{ $totalOrders}}</h2>
                </div>
            </div>
        </div>

        <div class="card card-custom p-4 flex-grow-1 d-flex justify-content-center">
            <div class="d-flex align-items-center gap-4">
                <div class="stat-icon-wrapper">
                    <i class="fas fa-wallet fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-tan-muted fw-medium text-uppercase" style="font-size: 0.8rem;">Today's Income</p>
                    <h2 class="fw-bold text-brown mb-0">Rp {{ isset($totalUang) ? number_format($totalUang, 0, ',', '.') : '0' }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
    
<div class="row g-4 mb-5">
    
    <div class="col-lg-7">
        <div class="card card-custom h-100 overflow-hidden">
            <div class="d-flex justify-content-between align-items-center pt-4 px-4 mb-3">
                <h5 class="serif-heading fw-bold mb-0">RECENT ORDERS</h5>
                <a href="{{ route('admin.booking') }}" class="text-brown text-decoration-none" style="font-size: 0.9rem;">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="px-4 pb-4 overflow-auto custom-scrollbar" style="max-height: 350px;">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                            <tr>
                                <td class="text-tan-muted">{{ $index + 1 }}</td>
                                <td class="text-brown fw-bold">{{ $booking->id }}</td>
                                <td class="text-brown">{{ $booking->user->name ?? ($booking->user->email ?? 'Guest') }}</td>
                                <td>
                                    @if ($booking->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                                    @elseif ($booking->status == 'completed')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Completed</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-tan-muted">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-tan-muted py-4">No recent orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <div class="col-lg-5">
        <div class="card card-custom h-100 overflow-hidden">
            <h5 class="pt-4 px-4 serif-heading fw-bold mb-3">NOTIFICATIONS</h5> 
            <div class="px-4 pb-4 overflow-auto custom-scrollbar" style="max-height: 350px;">
                <div class="d-flex flex-column gap-3">
                    @forelse ($notifications as $notification)
                        <div class="d-flex align-items-start gap-3 p-3 rounded" style="background-color: #FDFBF7; border: 1px solid var(--border-color);">
                            <div class="mt-1">
                                @if ($notification['type'] === 'booking')
                                    <i class="fas fa-box text-primary" style="font-size: 1.2rem;"></i>
                                @else
                                    <i class="fas fa-star text-warning" style="font-size: 1.2rem;"></i>
                                @endif
                            </div>
                            <div>
                                <p class="text-brown mb-1 fw-medium" style="font-size: 0.95rem;">{{ $notification['message'] }}</p>
                                <small class="text-tan-muted"><i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-tan-muted py-4">No notifications yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart');

        const months = @json($labels);
    const barData = @json($orderData);
    const lineData = @json($revenueData);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Orders',
                    data: barData,
                    backgroundColor: '#5C4334',
                    borderRadius: 6,
                    barThickness: 12
                },
                {
                    label: 'Revenue',
                    data: lineData,
                    type: 'line',
                    borderColor: '#4662E5',
                    backgroundColor: 'rgba(70, 98, 229, 0.1)',
                    fill: true,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>


@endsection