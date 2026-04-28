<header class="navbar">
  <div class="logo">
    <a href="{{ url('/') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Dapoer Tabi Logo">
    </a>
  </div>

  <nav>
    <ul>
      <li>
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
      </li>

      <li>
        <a href="{{ url('/aboutus') }}" class="{{ request()->is('aboutus') ? 'active' : '' }}">About Us</a>
      </li>

      <li>
        <a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a>
      </li>

      <li>
        <a href="{{ url('/contactus') }}" class="{{ request()->is('contactus') ? 'active' : '' }}">Contact Us</a>
      </li>
    </ul>
  </nav>

  <div class="nav-icons">
    <i class="bi bi-search search-icon" id="openSearch"></i>

    <!-- SEARCH -->
    <div id="searchOverlay" class="search-overlay">
      <form action="{{ url('/products') }}" method="GET" class="search-box">
      <input type="text" name="search" placeholder="Search product..." />
        <i class="bi bi-search"></i>
      </form>
    </div>

    <!-- CART -->
    <a href="{{ url('/cart') }}">
      <i class="bi bi-bag cart-icon"></i>
      <span class="cart-count">
        {{ count(session('cart', [])) }}
      </span>
    </a>

    <!-- PROFILE -->
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

  <!-- WAVE (FIXED, ga ada huruf s lagi) -->
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