
@extends('layouts.admin')

@section('content')

<style>
    /* New Container Layout */
    .orders-container {
        background-color: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 30px;
    }

    .page-title {
        color: #5C4334;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 25px;
    }

    /* Modern Pill Tabs */
    .custom-pill-tabs {
        border-bottom: none;
        gap: 10px;
        margin-bottom: 25px;
        background-color: #F8F5F0;
        padding: 6px;
        border-radius: 50px;
        display: inline-flex;
    }
    .custom-pill-tabs .nav-link {
        border: none;
        color: #A69485;
        background: transparent;
        padding: 8px 24px;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .custom-pill-tabs .nav-link:hover {
        color: #5C4334;
    }
    .custom-pill-tabs .nav-link.active {
        color: #FFFFFF !important;
        background-color: #5C4334 !important;
        box-shadow: 0 2px 8px rgba(92, 67, 52, 0.3);
    }

    /* Clean Minimalist Table */
    .minimal-table {
        width: 100%;
        border-collapse: collapse;
    }
    .minimal-table thead th {
        background-color: transparent;
        color: #A69485;
        padding: 15px 20px;
        border-bottom: 2px solid #F0EAE1;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .minimal-table tbody tr {
        transition: background-color 0.2s;
    }
    .minimal-table tbody tr:hover {
        background-color: #FCFAF7;
    }
    .minimal-table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #F0EAE1;
        color: #5C4334;
        font-size: 0.95rem;
    }

    /* Badges & Buttons */
    .status-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-pending { background-color: #FFF3CD; color: #856404; }
    .badge-completed { background-color: #D4EDDA; color: #155724; }

    .btn-detail {
        background-color: #F0EAE1;
        color: #5C4334;
        border: none;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-detail:hover {
        background-color: #EADFC8;
        color: #5C4334;
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 16px;
    }
    .modal-header {
        background-color: #F8F5F0;
        border-bottom: 1px solid #EADFC8;
        border-radius: 16px 16px 0 0;
    }
    .modal-title {
        color: #5C4334;
        font-weight: 700;
    }
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px dashed #EADFC8;
    }
    .detail-label { color: #A69485; font-size: 0.9rem; }
    .detail-value { color: #5C4334; font-weight: 600; text-align: right; }
</style>

<div class="col-12">
    <div class="orders-container">
        
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="page-title">Order Management</h3>
        </div>

        <ul class="nav custom-pill-tabs" id="bookingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All Orders</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab">Completed</button>
            </li>
        </ul>

        <div class="tab-content" id="bookingTabsContent">

            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="table-responsive">
                    <table class="minimal-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                @include('admin.partials.order_row', ['booking' => $booking])
                            @empty
                                <tr><td colspan="6" class="text-center py-4">No orders found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pending" role="tabpanel">
                <div class="table-responsive">
                    <table class="minimal-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingBookings as $booking)
                                @include('admin.partials.order_row', ['booking' => $booking])
                            @empty
                                <tr><td colspan="6" class="text-center py-4">No pending orders.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="done" role="tabpanel">
                <div class="table-responsive">
                    <table class="minimal-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doneBookings as $booking)
                                @include('admin.partials.order_row', ['booking' => $booking])
                            @empty
                                <tr><td colspan="6" class="text-center py-4">No completed orders.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@php
    // In a real app, this @include('admin.partials.order_row') would be a separate file.
    // For this exact fix, I am defining it right here so you don't have to create new files!
@endphp
@foreach($bookings as $booking)
    <div class="modal fade" id="orderModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details #ORD-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                    <h6 class="fw-bold text-brown mb-3">Customer Information</h6>
                    <div class="detail-row">
                        <span class="detail-label">Name</span>
                        <span class="detail-value">{{ $booking->user->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $booking->user->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Phone</span>
                        <span class="detail-value">{{ $booking->user->phone }}</span>
                    </div>

                    <h6 class="fw-bold text-brown mb-3 mt-4">Order Summary</h6>
                    <div class="detail-row">
                        <span class="detail-label">Product</span>
                        @foreach ($booking->items as $item)
                            {{ $item->product->name ?? '-' }} ({{ $item->qty }})<br>
                        @endforeach
                        
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Schedule</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} at {{ $booking->booking_time }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Payment Method</span>
                        <span class="detail-value">{{ $booking->payment_method }}</span>
                    </div>
                    <div class="detail-row border-0 mb-0 pb-0 mt-3">
                        <span class="detail-label fs-5 fw-bold text-brown">Total Amount</span>
                        <span class="detail-value fs-5" style="color: #48BB78;">Rp {{ number_format($booking->total, 0, ',', '.') }}</span>
                    </div>

                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Method</span>
                    <span class="detail-value">{{ $booking->payment_method }}</span>
                </div>

                @if(strtolower($booking->payment_method) == 'cashless')
                <div class="detail-row">
                    <span class="detail-label">Payment Proof</span>
                    <span class="detail-value">

                        @if($booking->payment_proof)
                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                                    style="width:120px; border-radius:10px; border:1px solid #ddd;">
                            </a>
                        @else
                            <span class="text-muted">No proof uploaded</span>
                        @endif

                    </span>
                </div>
                @endif
                <div class="modal-footer border-0 pt-0 justify-content-center">
                @if(
                        $booking->status === 'pending'
                        && strtolower($booking->payment_method) === 'cash'
                    )
                        <form action="{{ route('admin.booking.done', $booking->id) }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success ms-2">
                                Mark as Completed
                            </button>
                        </form>
                    @endif

                    
                    @if($booking->payment_method == 'cashless')

                        @if($booking->status == 'pending_verification')

                            <form action="{{ route('admin.booking.done',$booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success">
                                Approve Payment
                            </button>
                            </form>

                            <form action="{{ route('admin.booking.reject',$booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger">
                                Reject
                            </button>
                            </form>

                        @endif

                    @endif


                    
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection