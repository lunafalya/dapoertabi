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