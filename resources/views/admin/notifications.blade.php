@extends('layouts.admin')

@php
    $user = Auth::user();

    // DUmmy Data
    $notifications = [
        [
            'icon' => 'fas fa-box',
            'message' => 'Order masuk untuk "Bread" pukul "10.00-12.00"',
            'time' => '1 minutes ago',
            'is_read' => true, // This will make the button lighter tan
        ],
        [
            'icon' => 'far fa-comment',
            'message' => 'Ulasan bintang 5 diterima untuk "Pizza"',
            'time' => '5 minutes ago',
            'is_read' => false, // This keeps the button dark brown
        ],
        [
            'icon' => 'far fa-file-alt', // or fas fa-receipt
            'message' => 'Pesanan #12345 dikonfirmasi',
            'time' => '10 minutes ago',
            'is_read' => false,
        ],
        [
            'icon' => 'far fa-times-circle',
            'message' => 'Pesanan #12344 dibatalkan',
            'time' => '15 minutes ago',
            'is_read' => false,
        ]
    ];
@endphp

@section('content')

<style>
    /* Card Container */
    .notification-card {
        background-color: #FFFCF8;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: none;
    }

    /* Typography */
    .page-title {
        font-family: 'Abhaya Libre', serif;
        color: #5C4334;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .text-brown { color: #694F3C; }
    .text-light-brown { color: #A69485; }

    /* Pill-shaped Date Pickers */
    .date-picker-pill {
        border: 1px solid #A69485;
        border-radius: 50px;
        background: transparent;
        padding: 4px 16px;
        display: flex;
        align-items: center;
        width: 160px;
    }
    
    .date-picker-pill input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        color: #694F3C;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .date-picker-pill input::placeholder { color: #A69485; font-weight: 500; }
    .date-picker-pill i { color: #8B6A4B; cursor: pointer; }

    /* Table Styling */
    .table-custom {
        --bs-table-bg: transparent;
        margin-bottom: 0;
    }
    .table-custom tbody tr td {
        border-bottom: none; /* Removed standard borders */
        padding: 16px 8px;
        vertical-align: middle;
    }

    /* Mark as Read Buttons */
    .btn-mark-read {
        border-radius: 50px;
        padding: 6px 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        color: #FFFFFF;
        width: 120px;
        transition: opacity 0.2s;
    }
    .btn-mark-read:hover { opacity: 0.9; color: #FFFFFF; }
    
    .btn-read { background-color: #DBC5A0; } /* Lighter tan for read items */
    .btn-unread { background-color: #8B6A4B; } /* Dark brown for unread items */
    
</style>

<div class="notification-card p-5 mb-4">
    
    <h2 class="page-title mb-4">NOTIFICATION</h2>
    
    <div class="d-flex align-items-center gap-3 mb-4">
        
        <div class="date-picker-pill" id="startDateWrapper">
            <input type="text" id="startDatePicker" placeholder="mm / dd / yy" data-input>
            <i class="far fa-calendar-alt" data-toggle></i>
        </div>
        
        <div class="date-picker-pill" id="endDateWrapper">
            <input type="text" id="endDatePicker" placeholder="mm / dd / yy" data-input>
            <i class="far fa-calendar-alt" data-toggle></i>
        </div>
        
    </div>
    
    <div style="height: 1px; background-color: #F0EAE1; margin-bottom: 1rem;"></div>
    
    <div class="table-responsive">
        <table class="table table-custom">
            <tbody>
                @forelse ($notifications as $index => $notification)
                    <tr>
                        <td class="fw-bold text-brown text-center" style="width: 40px; font-size: 1.1rem;">
                            {{ $index + 1 }}
                        </td>

                        <td class="text-brown fw-medium">
                            <i class="{{ $notification['icon'] }} me-3" style="font-size: 1.1rem; color: #8B6A4B;"></i>
                            {{ $notification['message'] }}
                        </td>

                        <td class="text-light-brown text-end pe-4" style="font-size: 0.9rem; width: 140px;">
                            {{ $notification['time'] }}
                        </td>
                        
                        <td style="width: 140px; text-align: right;">
                            <button class="btn-mark-read {{ $notification['is_read'] ? 'btn-read' : 'btn-unread' }}">
                                Mark as Read
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-light-brown py-5">
                            No notifications yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Start Date
        flatpickr("#startDateWrapper", { 
            dateFormat: "m / d / y",
            wrap: true, 
            disableMobile: true
        });
        
        // Initialize End Date
        flatpickr("#endDateWrapper", { 
            dateFormat: "m / d / y",
            wrap: true, 
            disableMobile: true
        });
    });
</script>
@endsection
    