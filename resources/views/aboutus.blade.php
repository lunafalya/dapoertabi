<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body>
  <!-- HEADER -->
  @include('layouts.header')  

  <!-- HOME -->
  <section class="home1">
    <div class="home-content1">
      <h2>About Us</h2>
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
        <div class="item item1"><img src="{{ asset('images/about2.jpg') }}" alt=""></div>
        <div class="item item2"><img src="{{ asset('images/about5.jpg') }}" alt=""></div>
        <div class="item item3"><img src="{{ asset('images/about3.jpg') }}" alt=""></div>
        <div class="item item4"><img src="{{ asset('images/about4.jpg') }}" alt=""></div>
        <div class="item item5"><img src="{{ asset('images/about1.jpg') }}" alt=""></div>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section class="gallery">
    <div class="section-header">
      <h2>Our Gallery</h2>
    </div>

    <div class="product-gallery">
       <div class="gallery-item">
            <img src="{{ asset('images/1.jpg') }}">
            <div class="overlay">Palm Cheese Cookies</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/2.jpg') }}">
            <div class="overlay">Kastengel</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/3.jpg') }}">
            <div class="overlay">Oatmeal Cookies</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/4.jpg') }}">
            <div class="overlay">Putri Salju</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/5.jpg') }}">
            <div class="overlay">Nastar</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/6.jpeg') }}">
            <div class="overlay">Chococips Cookies</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/7.jpeg') }}">
            <div class="overlay">Almond London</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/8.jpeg') }}">
            <div class="overlay">Kue Kacang</div>
        </div>

        <div class="gallery-item">
            <img src="{{ asset('images/9.jpeg') }}">
            <div class="overlay">Lidah Kucing</div>
        </div>
    </div>
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

  <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
