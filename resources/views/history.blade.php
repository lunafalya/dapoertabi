<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="solid-nav">

  <!-- HEADER -->
  @include('layouts.header')  
  
   <section class="profile-page-container">
        <div class="profile-content">
            
            <div class="profile-tabs">
                <a href="{{ url('/profile') }}" class="tab-item inactive">Profile</a>
                <a href="#" class="tab-item active">Orders</a>
            </div>

    <div class="orders-history-container">
        <h2 class="history-title">History</h2>
        
        <table class="history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Transaction Date</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Review</th>
                </tr>
            </thead>
          <tbody>
            @foreach($bookings as $booking)
                @foreach($booking->items as $item)
                <tr>
                    {{-- ORDER ID --}}
                    <td>#{{ $booking->id }}</td>

                    {{-- DATE --}}
                    <td>{{ $booking->created_at->format('M d, Y H:i') }}</td>

                    {{-- PRODUCT --}}
                    <td>
                        {{ $item->product->name ?? '-' }}
                        <small class="text-muted">({{ $item->qty }})</small>
                    </td>

                    {{-- STATUS --}}
                    <td>
                        @if ($booking->status === 'pending')
                            <span class="status-pill status-pending-pill">Pending</span>
                        @elseif ($booking->status === 'done')
                            <span class="status-pill status-done-pill">Done</span>
                        @elseif ($booking->status === 'failed')
                            <span class="status-pill status-failed-pill">Failed</span>
                        @else
                            <span class="status-pill bg-light text-secondary">
                                {{ ucfirst($booking->status) }}
                            </span>
                        @endif
                    </td>

                    {{-- REVIEW --}}
                    <td>
                        @if ($booking->status === 'done')
                            @if ($item->review)
                                <span class="review-status added">Review Added</span>
                            @else
                                <a href="{{ route('review.create', $item->id) }}"
                                  class="review-btn add">
                                    Add Review
                                </a>
                            @endif
                        @else
                            <span class="review-status disabled">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

@if(session('success'))
<div id="successPopup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-check-circle"></i>
    <h3>{{ session('success') }}</h3>
    @if(session('payment') == 'cash')
      <p>Kindly pay upon delivery.</p>
    @elseif(session('payment') == 'cashless')
      <p>Please wait for our admin to verify your payment.</p>
    @else
      <p>We truly appreciate your feedback.</p>
    @endif
  </div>
</div>
@endif

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>