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
<body>
  <!-- HEADER -->
 <header class="navbar">
  <div class="logo">
    <a href="{{ url('/') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Dapoer Tabi Logo">
    </a>
  </div>
  <nav>
    <ul>
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/aboutus') }}">About Us</a></li>
      <li><a href="{{ url('/products') }}">Products</a></li>
      <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
    </ul>
  </nav>
  <div class="nav-icons">
   <i class="bi bi-search search-icon" id="openSearch"></i>
    <div id="searchOverlay" class="search-overlay">
      <div class="search-header">
        <h3>Search Products</h3>
        <i class="bi bi-x close-search" style="color: #8b5e3c; font-size: 35px;"></i>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search your favorite menu..." />
        <i class="bi bi-search"></i>
      </div>
    </div>

    <a href="{{ url('/cart') }}">
      <i class="bi bi-bag cart-icon"></i>
      <span class="cart-count">0</span>
    </a>

    <div class="dropdown">
      <i class="bi bi-person profile-icon" id="profileBtn"></i>

      <div class="dropdown-content" id="dropdownMenu">
        <a href="{{ url('/profile') }}">Profile</a>
        <a href="{{ url('/login') }}">Log In</a>
      </div>
    </div>
  </div> 
  <svg class="wave-nav" xmlns="http://www.w3.org/2000/svg" 
       viewBox="0 0 1440 320" preserveAspectRatio="none">
       <defs>
          <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#BF9B76; stop-opacity:1" />
            <stop offset="100%" style="stop-color:#EBD0B5; stop-opacity:1" />
          </linearGradient>
        </defs>
      <path fill="url(#grad1)" 
            d="M0,160 C480,250 960,60 1440,160 L1440,320 L0,320 Z"></path>
  </svg>
</header>

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

        @if(session('success'))
        <div id="successPopup" class="popup-success">
            <div class="popup-box">
                <h3>✅ {{ session('success') }}</h3>
                <p>Pesanan kamu sedang diproses.</p>
            </div>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('home') }}";
            }, 2500);
        </script>
        @endif

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
        <label style="font-weight: 400; color: white; text-align: left;">
          Name :
          <input type="text" name="name" value="{{ auth()->user()->name }}" readonly>
        </label>

        <label style="font-weight: 400; color: white; text-align: left;">
          Email :
          <input type="email" name="email" value="{{ auth()->user()->email }}" readonly>
        </label>
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

 <footer>
  <div class="footer-content">
    <img src="{{ asset('images/logo-bg.png') }}" alt="Dapoer Tabi Logo">
  <div class="footer-socials">
  <a href="https://facebook.com" target="_blank">
    <img src="{{ asset('images/1.png') }}" alt="Facebook">
  </a>

  <a href="https://twitter.com" target="_blank">
    <img src="{{ asset('images/2.png') }}" alt="Twitter">
  </a>

  <a href="https://linkedin.com" target="_blank">
    <img src="{{ asset('images/3.png') }}" alt="LinkedIn">
  </a>

  <a href="https://instagram.com" target="_blank">
    <img src="{{ asset('images/4.png') }}" alt="Instagram">
  </a>
</div>
    <div class="footer-separator"></div>

    <div class="footer-bottom">
      <div class="footer-links">
        <h4>Explore</h4>
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/aboutus') }}">About Us</a></li>
          <li><a href="{{ url('/products') }}">Products</a></li>
          <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
        </ul>
      </div>
      <div class="footer-contact">
        <h4>Keep in Touch</h4>
        <p>Mail: <a href="mailto:info@dapoertabi.com">info@dapoertabi.com</a></p>
        <p>Phone: <a href="https://wa.me/6281234567890">+62 812-3456-7890</a></p>
      </div>
    </div>
  </div>
</footer>


<script src="{{ asset('js/app.js') }}"></script>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

<script>
function closeSuccess() {
    document.getElementById('successModal').remove();
}
</script>

</body>
</html>