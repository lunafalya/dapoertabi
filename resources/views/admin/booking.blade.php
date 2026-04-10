@php
    // Dummy Auth User (prevents errors if you aren't logged in yet)
    $user = Auth::user() ?? (object)['name' => 'Admin', 'role' => 'admin', 'profile_photo' => null];

    // 1. Create a Master List of Dummy Bookings mimicking your Figma image
    $dummyBookings = [
        (object)[
            'id' => 1,
            'user' => (object)['email' => 'belibeli123@gmail.com'],
            'service' => (object)['name' => 'Bread', 'type' => 'Basic', 'file_path' => ''],
            'total_price' => 10000,
            'booking_date' => '2024-10-23',
            'booking_time' => '10.00-12.00',
            'status' => 'pending'
        ],
        (object)[
            'id' => 2,
            'user' => (object)['email' => 'a@.com'],
            'service' => (object)['name' => 'Cookies', 'type' => '12mm', 'file_path' => ''],
            'total_price' => 30000,
            'booking_date' => '2024-10-23',
            'booking_time' => '10.00-12.00',
            'status' => 'pending'
        ],
        (object)[
            'id' => 3, // Changed to 3 so it's unique, but mimics your layout
            'user' => (object)['email' => 'a@gmail.com'],
            'service' => (object)['name' => 'Donut', 'type' => '3d', 'file_path' => ''],
            'total_price' => 15000,
            'booking_date' => '2024-10-23',
            'booking_time' => '10.00-12.00',
            'status' => 'completed'
        ],
        (object)[
            'id' => 4,
            'user' => (object)['email' => 'hohopopp@gmail.com'],
            'service' => (object)['name' => 'Pizza', 'type' => '14mm', 'file_path' => ''],
            'total_price' => 15000,
            'booking_date' => '2024-10-23',
            'booking_time' => '10.00-12.00',
            'status' => 'completed'
        ],
    ];

    // 2. Simulate what the Backend Controller will eventually do
    $bookings = $dummyBookings; // All tab
    $pendingBookings = array_filter($dummyBookings, fn($b) => $b->status === 'pending'); // Pending tab
    $doneBookings = array_filter($dummyBookings, fn($b) => $b->status === 'completed'); // Done tab
@endphp
@extends('layouts.admin')

@section('content')

<style>
    /* Custom Tabs Styling */
    .booking-tabs {
        border-bottom: none;
        gap: 30px;
        margin-bottom: 30px;
        padding-left: 15px;
    }
    .booking-tabs .nav-link {
        border: none;
        color: var(--text-muted, #A69485);
        background: transparent;
        padding: 5px 10px;
        font-weight: 500;
        font-size: 1.05rem;
        border-radius: 0;
        transition: all 0.3s ease;
    }
    .booking-tabs .nav-link:hover {
        color: #EADFC8;
        border: none;
    }
    .booking-tabs .nav-link.active {
        color: #EADFC8 !important; /* Tan color for active text */
        background: transparent !important;
        border-bottom: 2px solid #EADFC8 !important; /* Tan underline */
    }

    /* Table Styling for "All" Tab */
    .table-custom-spacing {
        border-collapse: separate;
        border-spacing: 0 10px; /* Creates the gap between rows */
        width: 100%;
    }
    .table-custom-spacing thead th {
        background-color: #EADFC8; /* Tan header */
        color: #5C4334;
        padding: 15px;
        border: none;
        font-weight: 600;
        text-align: center;
    }
    .table-custom-spacing thead th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .table-custom-spacing thead th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    
    .table-custom-spacing tbody tr {
        background-color: #FFFCF8; /* White rows */
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .table-custom-spacing tbody td {
        padding: 15px;
        text-align: center;
        vertical-align: middle;
        border: none;
        color: #5C4334;
        font-weight: 500;
    }
    /* Rounded corners for the first and last cells of the white rows */
    .table-custom-spacing tbody td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .table-custom-spacing tbody td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

    /* Status Pills in Table */
    .status-pill {
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-pending-pill { background-color: #FFFDF5; color: #E5C17C; }
    .status-done-pill { background-color: #F0FFF4; color: #48BB78; }

    /* Card Styling for "Done" and "Pending" Tabs */
    .order-card {
        background-color: #FFFCF8;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .card-email-text {
        color: #E5C17C; /* Yellowish tan */
        font-weight: 600;
        margin-bottom: 15px;
    }
    .card-right-section {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .status-text-pending { color: #E5C17C; font-weight: 700; margin-bottom: 4px; }
    .status-text-done { color: #48BB78; font-weight: 700; margin-bottom: 4px; }
</style>

<div class="col-12">

    @if(session('success'))
        <div class="alert alert-success text-center fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => { document.getElementById('success-alert').style.display = 'none'; }, 3000);
        </script>
    @endif

    <ul class="nav nav-tabs booking-tabs" id="bookingTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab">Done</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
        </li>
    </ul>

    <div class="tab-content" id="bookingTabsContent">

        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table-custom-spacing">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $booking->user->email ?? '-' }}</td>
                                <td>{{ $booking->service->name ?? '-' }}</td>
                                <td>{{ $booking->service->type ?? 'Basic' }}</td> 
                                <td>Rp.{{ number_format($booking->total_price ?? 10000, 0, ',', '.') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}<br>
                                    <span style="font-size: 0.85em; color: var(--text-muted);">({{ $booking->booking_time ?? '10.00-12.00' }})</span>
                                </td>
                                <td>
                                    @if ($booking->status == 'pending')
                                        <span class="status-pill status-pending-pill">Pending</span>
                                    @elseif ($booking->status == 'completed' || $booking->status == 'approved' || $booking->status == 'done')
                                        <span class="status-pill status-done-pill">Completed</span>
                                    @else
                                        <span class="status-pill bg-light text-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4" style="background: #FFFCF8; border-radius: 8px;">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="tab-pane fade" id="done" role="tabpanel">
            <div class="booking-cards-list">
                @forelse ($doneBookings as $booking)
                    <div class="order-card">
                        <div>
                            <div class="card-email-text">{{ $booking->user->email ?? '-' }}</div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($booking->service->file_path ?? '')) }}"
                                    alt="Product Image"
                                    class="rounded me-3 shadow-sm"
                                    style="width: 70px; height: 70px; object-fit: cover; background-color: #f7f3e8;">
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #5C4334;">{{ $booking->service->name ?? '-' }}</h6>
                                    <small style="color: var(--text-muted);">ID: {{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-right-section">
                            <div>
                                <div class="status-text-done">Done</div>
                                <div style="color: var(--text-muted); font-size: 0.9rem;">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}, {{ $booking->booking_time ?? '15:24' }}
                                </div>
                            </div>
                            <div>
                                <div style="color: #5C4334; font-weight: 600; font-size: 0.9rem;">Total</div>
                                <div style="color: #5C4334; font-weight: 700; font-size: 1.1rem;">
                                    Rp.{{ number_format($booking->total_price ?? 10000, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-4" style="color: #EADFC8 !important;">No completed bookings found.</p>
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="pending" role="tabpanel">
            <div class="booking-cards-list">
                <!-- @forelse ($pendingBookings as $booking) -->
                    <div class="order-card">
                        <div>
                            <div class="card-email-text">{{ $booking->user->email ?? '-' }}</div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($booking->service->file_path ?? '')) }}"
                                    alt="Product Image"
                                    class="rounded me-3 shadow-sm"
                                    style="width: 70px; height: 70px; object-fit: cover; background-color: #f7f3e8;">
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #5C4334;">{{ $booking->service->name ?? '-' }}</h6>
                                    <small style="color: var(--text-muted);">ID: {{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-right-section">
                            <div>
                                <div class="status-text-pending">Pending</div>
                                <div style="color: var(--text-muted); font-size: 0.9rem;">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}, {{ $booking->booking_time ?? '15:24' }}
                                </div>
                            </div>
                            <div>
                                <div style="color: #5C4334; font-weight: 600; font-size: 0.9rem;">Total</div>
                                <div style="color: #5C4334; font-weight: 700; font-size: 1.1rem;">
                                    Rp.{{ number_format($booking->total_price ?? 10000, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-4" style="color: #EADFC8 !important;">No pending bookings found.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection