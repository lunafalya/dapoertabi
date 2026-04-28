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
    <h2 class="form-title">Payment QRIS/Gopay</h2>
    <p class="form-subtitle">Upload your payment proof to complete the order</p>

    <!-- TOTAL -->
    <div class="checkout-total">
      <span>Total</span>
      <p>
        Rp {{ number_format($order->total,0,',','.') }}
      </p>
    </div>

    <!-- QR CODE -->
    <div style="text-align:center; margin:5px 0 0;">
        <img src="{{ asset('images/qrcode.jpeg') }}" width="280">
    </div>

    <!-- FORM UPLOAD -->
    <form class="checkout-form"
          action="{{ route('payment.upload',$order->id) }}"
          method="POST"
          enctype="multipart/form-data">

      @csrf

      <!-- UPLOAD -->
      <div class="input-row file-upload">
        <label>
          Upload Proof of Payment
        </label>
        <input type="file" name="proof" required>
      </div>

      <!-- BUTTON -->
      <button class="order-btn">
        Submit Payment
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
      <p>Please wait for our admin to verify your payment</p>
    </div>
</div>
@endif

</body>
</html>