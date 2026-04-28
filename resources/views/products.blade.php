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
  @include('layouts.header')  

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
        <span class="menu-sort-label">Sort by:</span>
        <select class="menu-sort-select">
          <option>Latest</option>
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
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart-form">
                @csrf
                <button type="submit" class="add-to-cart-btn">
                    Add to Cart
                </button>
            </form>
          </div>
          @endforeach
        </div>

      </div>
    </div>
</div>
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

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

<div id="cart-popup" class="cart-popup">
    <div class="popup-box">
      <i class="bi bi-check-circle"></i>
      <h3>Product added to cart 🛒</h3>
      <a href="{{ route('cart.index') }}" class="view-btn">View Cart</a>
    </div>
</div>
</body>
</html>
