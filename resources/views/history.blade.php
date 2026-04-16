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
        @auth
        <a href="{{ url('/profile') }}">Profile</a>

        <form action="{{ url('/logout') }}" method="POST">
        @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth

        @guest
            <a href="{{ url('/login') }}">Log In</a>
        @endguest
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

</body>
</html>