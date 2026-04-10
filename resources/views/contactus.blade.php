<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
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
      <li><a href="{{ url('/contactus') }}" class="active">Contact Us</a></li>
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

  <!-- CONTACT US -->
  <section class="home1">
    <div class="home-content1">
      <h2>Contact Us</h2>
    </div>   
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" 
       viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="#C7A07A" fill-opacity="1" 
            d="M0,160 C480,480 960,30 1440,160 L1440,320 L0,320 Z"></path>
    </svg>
  </section>

  <section class="about-section">
    <div class="contact-container">
      <div class="contact-text">
        <h2>Get In Touch With Us</h2>
        <p>
          We’d love to hear from you! Reach us through the following channels:
        </p>
      </div>
    </div>

    <div class="info-container">
      <div class="info-text">
        <a href="mailto:info@dapoertabi.com" class="contact-item">
          <i class="bi bi-envelope contact-icon"></i>
          <p class="info-text mb-0">info@dapoertabi.com</p>
        </a>

        <a href="https://wa.me/6281234567890" class="contact-item">
            <i class="bi bi-telephone contact-icon"></i>
            <p class="info-text mb-0">+62 812-3456-7890</p>
        </a>

         <a href="https://instagram.com/dapoer_tabi" class="contact-item">
            <i class="bi bi-instagram contact-icon"></i>
            <p class="info-text mb-0">@dapoer_tabi</p>
        </a>

        <a href="https://www.google.com/maps" class="contact-item">
            <i class="bi bi-geo-alt contact-icon"></i>
            <p class="info-text">Jl. Raya Bekasi Timur No. 12 RT 003 / RW 005, Kelurahan Duren Jaya, Kecamatan Bekasi Timur, Kota Bekasi, Jawa Barat 17111</p>
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
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