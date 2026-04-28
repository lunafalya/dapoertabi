<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-papV7Lz+1C1XhTdTlUuZ9fJ6ejn4F1eZp8Bk/hTjd6I7jLqB3uYkXHExO3+fEo+y4yBhHP+Gz/Jw4GJr7C0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="solid-nav">
  <!-- HEADER -->
  @include('layouts.header')  

<section class="booking-hero">
  <div class="booking-card">
    <h2 class="form-title">Checkout Form</h2>
    <p class="form-subtitle">Please fill your details to complete the order</p>

    <form class="checkout-form" method="POST" action="{{ route('checkout.store') }}">
      @csrf

      @php
          $selectedProducts = collect($cart)
              ->map(fn($item) => $item['name'].' ('.$item['qty'].')')
              ->implode(', ');
      @endphp

      <div class="input-row">
          <input type="text" value="{{ $selectedProducts }}" readonly>
      </div>
    
      @php
      $estimateDate = \Carbon\Carbon::now()->addDays(3);
      @endphp

      <div class="input-row">
          <input type="text"
              value="Estimated ready: {{ $estimateDate->format('d M Y') }}"
              readonly>
      </div>

      <!-- NAMA & EMAIL -->
      <div class="input-row">
          <input type="text" name="name" value="{{ auth()->user()->name }}" readonly>
          <input type="email" name="email" value="{{ auth()->user()->email }}" readonly>
      </div>

      <!-- NO TELP -->
      <div class="input-row">
        <input type="text" name="phone" value="{{ auth()->user()->phone }}" readonly>
      </div>

      <!-- KELURAHAN -->
      <div class="input-row">
        <div class="select-wrapper">
          <select name="urban_village" required>
            <option value="" disabled selected>Urban Village</option>
            <option>Aren Jaya</option>
            <option>Bekasi Jaya</option>
            <option>Duren Jaya</option>
            <option>Margahayu</option>
          </select>
          <i class="bi bi-chevron-down select-icon"></i>
        </div>
      </div>

      <div class="input-row-area">
        <textarea name="address" placeholder="Address" required></textarea>
      </div>

      <div class="input-row-area">
        <textarea name="notes" placeholder="Notes"></textarea>
      </div>

      <!-- PAYMENT -->
      <div class="payment-method">
        <label>Payment Method:</label>

        <div class="radio-group">
          <label>
            <input type="radio" name="payment" value="cash" required>
            Cash
          </label>

          <label>
            <input type="radio" name="payment" value="cashless">
            Cashless
          </label>
        </div>
      </div>

      @php
      $total = collect($cart)->sum(function($item){
          return $item['price'] * $item['qty'];
      });
      @endphp

      <div class="checkout-total">
          <span>Total</span>
          <p id="checkoutTotal">
              Rp {{ number_format($total,0,',','.') }}
          </p>
      </div>

    <button type="submit" class="order-btn">
        Proceed to Checkout
    </button>

    </form>
  </div>
</section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

@if(session('success'))
<div id="successPopup" class="cart-popup">
    <div class="popup-box">
      <i class="bi bi-check-circle"></i>
      <h3>{{ session('success') }}</h3>
      <p>Kindly pay upon delivery</p>
    </div>
</div>
@endif

</body>
</html>