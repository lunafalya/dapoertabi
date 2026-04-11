<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
  
</head>
<body class="detail-page"> 

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

  <section class="detail-section">
    <div class="detail-container">
        
        <div class="detail-image-area">
            <img src="{{ asset('storage/' . $product->file_path) }}" alt="{{ $product->name }}" class="main-product-image">
        </div>
        
        <div class="detail-content">
            <p class="order-brand">Dapoer Tabi</p>
            <h1 class="order-title">{{ $product->name }}</h1>
            <h2 class="order-price">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
            <p>
              ⭐{{ number_format($product->reviews->avg('rating'), 1) }}/5
              ({{ $product->reviews->count() }} reviews)
            </p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
                @csrf
                <button type="submit" class="order-now-btn" id="addtocartButton">
                    Add to Cart
                </button>
            </form>
            
            <div class="tab-navigation">
                <span class="tab-item active" data-tab="description">Description</span>
                <span class="tab-item" data-tab="review">Review</span>
            </div>
            
            <div class="tab-content active" id="description-content">
                <p class="content-text">
                    {{ $product->description ?? 'No description available.' }}
                </p>
            </div>
            
            <div class="tab-content" id="review-content">
              @if($product->reviews->isNotEmpty())
                  @foreach($product->reviews as $review)
                      <div class="review-item">
                          <p class="reviewer-name">
                              {{ $review->user->name }}
                          </p>

                          <div class="rating">
                              @for($i = 1; $i <= 5; $i++)
                                  <i class="fa-solid fa-star
                                      {{ $i <= $review->rating ? 'active' : 'inactive' }}">
                                  </i>
                              @endfor
                          </div>

                          <p class="review-text">
                              "{{ $review->review }}"
                          </p>
                      </div>
                  @endforeach
              @else
                  <p class="no-review">No reviews yet.</p>
              @endif

          </div>
                </div>

                
            
        </div>
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


  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabItems = document.querySelectorAll('.tab-item');
        const tabContents = document.querySelectorAll('.tab-content');

        tabItems.forEach(item => {
            item.addEventListener('click', function() {
                tabItems.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const targetTab = this.getAttribute('data-tab');
                tabContents.forEach(content => content.classList.remove('active'));
                document.getElementById(targetTab + '-content').classList.add('active');
            });
        });
    });

    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    
    if(profileBtn && dropdownMenu) {
        profileBtn.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });
        window.onclick = function(event) {
            if (!event.target.matches('#profileBtn')) {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            }
        }
    }

  document.addEventListener("DOMContentLoaded", function () {

  const button = document.getElementById("addtocartButton");
  const popup = document.getElementById("cart-popup");

  if (!button || !popup) return;

  button.addEventListener("click", function () {

    popup.classList.add("show");

    setTimeout(() => {
      popup.classList.remove("show");
    }, 2000);

  });

});
  </script>

<div id="cart-popup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-check-circle"></i>
    <p>Product added to cart 🛒</p>
    <a href="{{ url('/cart') }}" class="view-btn">View Cart</a>
  </div>
</div>

</body>
</html>