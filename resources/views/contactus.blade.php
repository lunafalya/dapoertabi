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
  @include('layouts.header')  

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
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>