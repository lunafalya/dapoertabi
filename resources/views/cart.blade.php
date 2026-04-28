<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="detail-page"> 

  <!-- HEADER -->
  @include('layouts.header')  

  <section class="cart-section">
    <div class="cart-container">
       @if(empty($cart) || count($cart) == 0)

            <div class="cart-empty">
                <h3>Your cart is empty!</h3>
                <p>Please add a product first.</p>
            </div>
        @else

        @foreach($cart as $id => $item)
        <div class="cart-item">
            <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">

            <div class="cart-name">{{ $item['name'] }}</div>

            <div class="cart-price" data-price="{{ $item['price'] }}">
                Rp. {{ number_format($item['price'],0,',','.') }}
            </div>

            <form action="{{ route('cart.update', $id) }}" method="POST" class="qty-box">
                @csrf
                <button name="qty" value="{{ $item['qty'] - 1 }}" class="qty-btn">-</button>
                <span class="qty-value">{{ $item['qty'] }}</span>
                <button name="qty" value="{{ $item['qty'] + 1 }}" class="qty-btn">+</button>
            </form>

            <div class="cart-total">
                Rp. {{ number_format($item['price'] * $item['qty'],0,',','.') }}
            </div>

            <form action="{{ route('cart.remove', $id) }}" method="POST" class="delete-form">
                @csrf
                <button type="button" class="delete-btn">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

        </div>
        @endforeach
    </div>

        </div>
    <!-- Total -->
    @php $total = 0 @endphp
      @foreach($cart as $item)
          @php $total += $item['price'] * $item['qty'] @endphp
      @endforeach

      <div class="cart-summary">
          <div>Subtotal</div>
          <div>Rp {{ number_format($total,0,',','.') }}</div>
      </div>

    <a href="{{ route('checkout.store') }}">
    <button class="order-btn">Proceed to Checkout</button>
    </a>
    @endif
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

<div id="confirm-popup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-exclamation-circle"></i>
    <h3>Are you sure you want to remove this item?</h3>
    <div class="mt-3 d-flex justify-content-center gap-2">
      <button id="confirm-yes" class="delete-cart-btn">Delete</button>
      <button id="confirm-no" class="no-delete-btn">Cancel</button>
    </div>
  </div>
</div>

<div id="delete-popup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-trash"></i>
    <p>Product removed from cart 🗑️</p>
  </div>
</div>

</body>
</html>