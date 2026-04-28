<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Dapoer Tabi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body>
  <!-- HEADER -->

    @include('layouts.header')  

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
        <div class="item item2"><img src="{{ asset('images/about2.jpg') }}" alt=""></div>
        <div class="item item3"><img src="{{ asset('images/about3.jpg') }}" alt=""></div>
        <div class="item item1"><img src="{{ asset('images/about1.jpg') }}" alt=""></div>
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
      @if($products->count() > 3)
      <button class="carousel-btn prev">
        <i class="bi bi-chevron-left"></i>
      </button>      
      @endif
      <div class="carousel">
        @foreach ($products as $product)
          <div class="card">
            <a href="{{ route('products.show', $product->id) }}"class="service-link">
              <img src="{{ asset('storage/'.$product->file_path) }}" alt="{{ $product->name }}">
              <p class="home-card">{{ $product->name }}</p>
            </a>
          </div>
        @endforeach
      </div>
      @if($products->count() > 3)
      <button class="carousel-btn next">
        <i class="bi bi-chevron-right"></i>
      </button>
      @endif
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials">
    <h2>What Our Clients Say</h2>
    <div class="testimonial-container">
      <div class="testimonial-list">
        <figure class="snip1533">
          <figcaption>
            <blockquote>
            <p>These cookies are simply irresistible! The buttery texture melts in your mouth, and I keep coming back for more.</p>
            </blockquote>
            <h3>Emily R</h3>
          </figcaption>
        </figure>
        <figure class="snip1533">
          <figcaption>
            <blockquote>
              <p>I ordered a gift box for my parents, and they loved it. Fresh, crunchy, and beautifully packaged.</p>
            </blockquote>
            <h3>Sri Rahayu</h3>
          </figcaption>
        </figure>
        <figure class="snip1533">
          <figcaption>
            <blockquote>
              <p>Delivery was fast, and the cookies arrived in perfect condition. They taste just like they came straight out of the oven.</p>
            </blockquote>
            <h3>Amanda Z</h3>
          </figcaption>
        </figure>
        <figure class="snip1533">
          <figcaption>
            <blockquote>
              <p>I’ve tried many brands, but these stand out. Every bite feels premium and full of flavor.</p>
            </blockquote>
            <h3>Andi Mulyono</h3>
          </figcaption>
        </figure>
        <figure class="snip1533">
          <figcaption>
            <blockquote>
              <p>It is not a lack of love, but a lack of friendship that makes unhappy marriages.</p>
            </blockquote>
            <h3>Wulandari</h3>
          </figcaption>
        </figure>
        <figure class="snip1533">
          <figcaption>
            <blockquote>
              <p>The variety pack is amazing! Each flavor has its own charm, and none disappoint.</p>
            </blockquote>
            <h3>Karina Yu</h3>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
