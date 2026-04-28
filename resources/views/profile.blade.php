<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="solid-nav">
  <!-- HEADER -->
    @include('layouts.header')  

   <section class="profile-page-container">
        <div class="profile-content">
            
            <div class="profile-tabs">
                <a href="#" class="tab-item active">Profile</a>
                <a href="{{ url('/history') }}" class="tab-item inactive">Orders</a>
            </div>

            <div class="profile-avatar">
                    @if(auth()->user() && auth()->user()->profile_photo)
                          <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" width="80" height="80" style="border-radius:50%;object-fit:cover;">
                      @else
                        <svg viewBox="0 0 24 24" fill="currentColor" width="80" height="80">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
            </div>

            <form class="profile-form">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" 
                      value="{{ auth()->user()->name }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" 
                       value="{{ auth()->user()->email }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" 
                      value="{{ auth()->user()->phone }}" readonly>
                </div>

                <a href="{{ route('profile.edit') }}" class="edit-button">Edit Profile</a>

            </form>

        </div>
    </section>

  <!-- FOOTER -->
    @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

@if(session('success'))
<div id="successPopup" class="cart-popup show">
  <div class="popup-box">
    <i class="bi bi-check-circle"></i>
    <h3>Profile Updated</h3>
    <p>Your profile has been successfully updated.</p>
  </div>
</div>
@endif

@if(session('error'))
<div id="errorPopup" class="cart-popup show">
  <div class="popup-box">
    <i class="bi bi-x-circle"></i>
    <p>{{ session('error') }}</p>
  </div>
</div>
@endif

</body>
</html>