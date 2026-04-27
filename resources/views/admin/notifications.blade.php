@extends('layouts.admin')
@section('content')

<style>
    /* Main Container */
    .notification-wrapper {
        background-color: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 30px;
        min-height: 75vh;
    }

    /* Typography */
    .page-title {
        font-family: 'Playfair Display', 'Times New Roman', serif;
        color: #5C4334;
        font-weight: 700;
        margin-bottom: 0;
    }

    .system-font {
        font-family: system-ui, -apple-system, sans-serif;
    }

    .text-brown { color: #5C4334; }
    .text-light-brown { color: #A69485; }

    /* Modern Date Pickers */
    .filter-container {
        display: flex;
        gap: 12px;
    }
    
    .date-picker-pill {
        border: 1px solid #EADFC8;
        border-radius: 8px; 
        background: #FDFBF7;
        padding: 8px 16px;
        display: flex;
        align-items: center;
        width: 170px;
        transition: border-color 0.2s;
    }
    .date-picker-pill:focus-within { border-color: #8B6A4B; }
    
    .date-picker-pill input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        color: #5C4334;
        font-size: 0.85rem;
        font-weight: 500;
        font-family: system-ui, -apple-system, sans-serif;
    }
    
    .date-picker-pill input::placeholder { color: #A69485; font-weight: 400; }
    .date-picker-pill i { color: #A69485; cursor: pointer; transition: color 0.2s; }
    .date-picker-pill:hover i { color: #5C4334; }

    /* Notification Flex Rows */
    .notif-row {
        display: flex;
        align-items: center;
        padding: 20px;
        background-color: #FDFBF7;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 1px solid #F0EAE1;
        transition: all 0.3s ease;
    }
    
    .notif-row:hover {
        background-color: #FFFCF8;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        transform: translateY(-1px);
    }

    /* Unread vs Read States */
    .unread-notif {
        border-left: 4px solid #5C4334; 
        background-color: #FFFCF8;
    }
    .read-notif {
        border-left: 4px solid transparent;
        opacity: 0.75; 
    }

    .notif-icon-wrapper {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 20px;
    }
    
    .unread-notif .notif-icon-wrapper { background-color: #EADFC8; color: #5C4334; }
    .read-notif .notif-icon-wrapper { background-color: #F0EAE1; color: #A69485; }

    /* Interactive Buttons */
    .btn-mark-read {
        border-radius: 50px;
        padding: 6px 18px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        width: 130px;
        transition: all 0.2s;
        font-family: system-ui, -apple-system, sans-serif;
    }
    .btn-mark-read:active { transform: scale(0.95); }
    
    .btn-unread { background-color: #5C4334; color: #FFFFFF; }
    .btn-unread:hover { background-color: #8B6A4B; }
    
    .btn-read { background-color: #EFEBE1; color: #A69485; pointer-events: none; } 

    .filtering-overlay { opacity: 0.4; pointer-events: none; }
</style>

<div class="col-12">
    <div class="notification-wrapper">
        
        <div class="d-flex justify-content-between align-items-end mb-4 pb-3" style="border-bottom: 2px solid #F8F5F0;">
            <div>
                <h2 class="page-title">Notifications</h2>
                <p class="text-light-brown system-font mb-0 mt-1" style="font-size: 0.9rem;">Stay updated with your latest alerts.</p>
            </div>
            
            <div class="filter-container">
                <div class="date-picker-pill" id="startDateWrapper">
                    <input type="text" id="startDatePicker" placeholder="Start Date" data-input>
                    <i class="far fa-calendar-alt" data-toggle></i>
                </div>
                <div class="date-picker-pill" id="endDateWrapper">
                    <input type="text" id="endDatePicker" placeholder="End Date" data-input>
                    <i class="far fa-calendar-alt" data-toggle></i>
                </div>
            </div>
        </div>
        
        <div id="notificationsList" class="system-font">
    @forelse ($notifications as $notif)
        <div class="notif-row">

            <div class="notif-icon-wrapper">
                <i class="{{ $notif['icon'] }} fs-5"></i>
            </div>

            <div class="flex-grow-1 pe-4">
                <h6 class="text-brown mb-1 fw-normal">
                    {{ $notif['message'] }}
                </h6>
                <small class="text-light-brown fw-medium">
                    <i class="far fa-clock me-1"></i>{{ $notif['time'] }}
                </small>
            </div>

        </div>
    @empty
        <div class="text-center text-light-brown py-5 mt-4">
            <i class="far fa-bell-slash fs-1 mb-3 opacity-50"></i>
            <h5>All caught up!</h5>
            <p>You have no notifications.</p>
        </div>
    @endforelse
</div>

    </div>
</div>

<script>
    // 1. Mark As Read Functionality
    function markAsRead(id, buttonElement) {
        buttonElement.classList.remove('btn-unread');
        buttonElement.classList.add('btn-read');
        buttonElement.innerText = 'Read ✓';
        
        const notifRow = document.getElementById('notif-' + id);
        if(notifRow) {
            notifRow.classList.remove('unread-notif');
            notifRow.classList.add('read-notif');
            
            const messageText = notifRow.querySelector('h6');
            if(messageText) {
                messageText.classList.remove('fw-bold');
                messageText.classList.add('fw-normal');
            }
        }
    }

    // 2. Calendar Initialization
    document.addEventListener('DOMContentLoaded', function () {
        
        const simulateFilter = function(selectedDates, dateStr, instance) {
            if(dateStr) {
                const list = document.getElementById('notificationsList');
                list.classList.add('filtering-overlay'); 
                
                setTimeout(() => {
                    list.classList.remove('filtering-overlay');
                }, 500);
            }
        };

        // Flatpickr setup
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#startDateWrapper", { 
                dateFormat: "M j, Y", 
                wrap: true, 
                disableMobile: true,
                onChange: simulateFilter 
            });
            
            flatpickr("#endDateWrapper", { 
                dateFormat: "M j, Y",
                wrap: true, 
                disableMobile: true,
                onChange: simulateFilter
            });
        } else {
            console.error("Flatpickr library is not loaded!");
        }
    });
</script>









@endsection
    