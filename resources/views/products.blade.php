<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
      <li><a href="{{ url('/products') }}" class="active">Products</a></li>
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

    <!-- OUR PRODUCTS -->
  <section class="home1">
    <div class="home-content1">
      <h2>Our Products</h2>
    </div>
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" 
       viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="#C7A07A" fill-opacity="1" 
            d="M0,160 C480,480 960,30 1440,160 L1440,320 L0,320 Z"></path>
    </svg>
  </section>

  <section class="about-section">
  <div class="menu-page">
      <div class="menu-topbar">
        <span class="menu-sort-label">Urutkan:</span>
        <select class="menu-sort-select">
          <option>Terbaru</option>
        </select>
        <i class="bi bi-chevron-down filter-icon"></i>
      </div>
    <div class="menu-container">

      <!-- SIDEBAR -->
      <div class="menu-sidebar">
        <h3 class="menu-title">Category</h3>
        <ul class="menu-list">
          <li class="menu-item active" data-category="all">All</li>
          <li class="menu-item" data-category="kuker">Kue Kering</li>
          <li class="menu-item" data-category="kue">Cake</li>
          <li class="menu-item" data-category="donut">Donut</li>
          <li class="menu-item" data-category="bomboloni">Bomboloni</li>
          <li class="menu-item" data-category="pizza">Pizza</li>
        </ul>
      </div>

      <!-- CONTENT -->
      <div   class="menu-content">
        <!-- GRID -->
        <div class="menu-grid">
          @foreach($products as $product)
          <div class="menu-card"  data-category="{{ $product->category }}">
            <a href="{{ route('products.show', $product->id) }}">
                <img src="{{ asset('storage/'.$product->file_path) }}" class="menu-img">
            </a>
            <h4 class="menu-name">{{ $product->name }}</h4>
            <p class="menu-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          </div>
          @endforeach
        </div>

      </div>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterItems = document.querySelectorAll('.service-filter li');
    const serviceItems = document.querySelectorAll('.service-item');

    filterItems.forEach(filter => {
        filter.addEventListener('click', () => {
            // ubah status aktif pada tombol filter
            filterItems.forEach(f => f.classList.remove('active'));
            filter.classList.add('active');

            const filterValue = filter.getAttribute('data-filter');

            serviceItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category').toLowerCase();

                if (filterValue === 'all' || itemCategory === filterValue) {
                    item.style.display = 'block';
                    item.classList.add('show');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('show');
                }
            });
        });
    });
});
</script>

<script>
const filterTabs = document.querySelectorAll('.service-filter li');
const serviceItems = document.querySelectorAll('.service-item');

filterTabs.forEach(tab => {
tab.addEventListener('click', () => {
filterTabs.forEach(t => t.classList.remove('active'));
tab.classList.add('active');
const filter = tab.getAttribute('data-filter');

serviceItems.forEach(item => {
        let isMatch = false;
        
        if (filter === 'all') {
            isMatch = true;
        } else if (filter === 'kuker' && itemType.includes('kuker')) {
            isMatch = true;
        } else if (filter === 'pizza' && itemType.includes('pizza')) {
            isMatch = true;
        } else if (filter === 'donut' && itemType.includes('donut')) {
            isMatch = true;
        } else if (filter === 'kue' && itemType.includes('kue')) {
            isMatch = true;
        } else if (filter === 'bomboloni' && itemType.includes('bomboloni')) {
            isMatch = true;
        }
        
item.style.display = isMatch ? 'block' : 'none';
});
});
});
</script>
</body>
</html>
