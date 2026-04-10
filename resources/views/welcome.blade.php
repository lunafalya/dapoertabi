<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Dapoer Tabi</title>
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
      <li><a href="#" class="active">Home</a></li>
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

  <!-- HOME -->
  <section class="home">
    <div class="home-content">
      <h1>Fresh Homemade Treats for You</h1>
      <p>Enjoy delicious homemade cakes and sweet treats made with love. Perfect for every moment and every celebration.</p>
      <div class="order-home-btn">
        <a href="{{ url('/products') }}" class="btn">Order Now 
          <span class="arrow">
            <i class="bi bi-arrow-right-short"></i>
          </span>
        </a>
      </div>    
    </div>
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" 
       viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="#C7A07A" fill-opacity="1" 
            d="M0,160 C480,480 960,30 1440,160 L1440,320 L0,320 Z"></path>
    </svg>
  </section>

  <!-- ABOUT US -->
  <section class="about-section">
    <div class="about-container">
      <div class="about-text">
        <h2>About Us</h2>
        <p>
          <strong>Dapoer Tabi</strong> is a home-based culinary business located in East Bekasi, offering a variety of homemade cakes and dishes with warm, authentic flavors. We are committed to using quality ingredients to ensure the best taste and customer satisfaction.  
          Currently, Dapoer Tabi <strong>only serves orders within the East Bekasi area</strong>, allowing us to maintain product quality and freshness for every customer.
        </p>
      </div>


      <div class="about-gallery">
        <div class="item item1"><img src="{{ asset('images/about1.jpg') }}" alt=""></div>
        <div class="item item2"><img src="{{ asset('images/about2.jpg') }}" alt=""></div>
        <div class="item item3"><img src="{{ asset('images/about3.jpg') }}" alt=""></div>
        <div class="item item4"><img src="{{ asset('images/about4.jpg') }}" alt=""></div>
        <div class="item item5"><img src="{{ asset('images/about5.jpg') }}" alt=""></div>
      </div>
    </div>
  </section>

  <!-- OUR PRODUCT -->
  <section class="services">
    <div class="section-header">
      <h2>Our Products</h2>
      <a href="{{ url('/products') }}" class="view-all">
        View All
        <span class="arrow">
          <i class="bi bi-arrow-right-short"></i>
        </span>
      </a>
    </div>

    <div class="carousel-container">
      <button class="carousel-btn prev">
        <i class="bi bi-chevron-left"></i>
      </button>      
      <div class="carousel">
        <div class="card">
          <a href="{{ url('/detail') }}"class="service-link">
          <img src="{{ asset('images/4.jpg') }}" alt="Putri Salju">
          <p>Putri Salju</p>
        </div>
        <div class="card">
          <a href="{{ url('/detail') }}"class="service-link">
          <img src="{{ asset('images/1.jpg') }}" alt="Palm Cheese Cookies">
          <p>Palm Cheese Cookies</p>
        </div>
        <div class="card">
          <a href="{{ url('/detail') }}"class="service-link">
          <img src="{{ asset('images/2.jpg') }}" alt="Kastengel">
          <p>Kastengel  </p>
        </div>
        <div class="card">
          <a href="{{ url('/detail') }}"class="service-link">
          <img src="{{ asset('images/3.jpg') }}" alt="Oatmeal Cookies">
          <p>Oatmeal Cookies</p>
        </div>
        <div class="card">
          <a href="{{ url('/detail') }}"class="service-link">
          <img src="{{ asset('images/5.jpg') }}" alt="Nastar">
          <p>Nastar</p>
</a>
        </div>
      </div>
      <button class="carousel-btn next">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials">
    <h2>What Our Clients Say</h2>
    <div class="testimonial-list">
      <div class="testimonial">
        <img src="{{ asset('images/kutip.png') }}" alt="kutip" class="quote-icon" >
        <p>“The cookies are perfectly crunchy, with just the right sweetness. The packaging is beautiful, making them ideal for festive hampers!”</p>
        <span>- Rina, Margahayu</span>
      </div>
      <div class="testimonial">
        <img src="{{ asset('images/kutip.png') }}" alt="kutip" class="quote-icon">
        <p>“I love the pineapple-filled nastar. The taste is fresh and not overwhelming—my kids can’t get enough of them.”</p>
        <span>- Andi, Bekasi Jaya</span>
      </div>
      <div class="testimonial">
        <img src="{{ asset('images/kutip.png') }}" alt="kutip" class="quote-icon">
        <p>“The chocolate cookies melt in your mouth. They taste homemade yet look so elegant.”</p>
        <span>- Dewi, Margahayu</span>
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
