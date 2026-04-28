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

  @include('layouts.header')  

  <section class="detail-section">
    <div class="detail-container">
        
        <div class="detail-image-area">
            <img src="{{ asset('storage/' . $product->file_path) }}" alt="{{ $product->name }}" class="main-product-image">
        </div>
        
        <div class="detail-content">
            <h1 class="order-title">{{ $product->name }}</h1>
            <h2 class="order-price">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
            <p class="ratings">
              ⭐{{ number_format($product->reviews->avg('rating'), 1) }}/5
              ({{ $product->reviews->count() }} reviews)
            </p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="add-to-cart-btn" id="addtocartButton{{ $product->id }}">
                    Add to Cart
                </button>
            </form>
            
            <div class="tab-navigation">
                <span class="tab-item active small" data-tab="description">Description</span>
                <span class="tab-item small" data-tab="review">Review</span>
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

                          <p class="content-text">
                              "{{ $review->review }}"
                          </p>
                      </div>
                  @endforeach
              @else
                  <p class="content-text">No reviews yet.</p>
              @endif

          </div>
                </div>

                
            
        </div>
    </div>
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<div id="cart-popup" class="cart-popup">
    <div class="popup-box">
      <i class="bi bi-check-circle"></i>
      <h3>Product added to cart 🛒</h3>
      <a href="{{ route('cart.index') }}" class="view-btn">View Cart</a>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>