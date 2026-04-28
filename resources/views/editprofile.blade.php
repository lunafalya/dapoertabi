<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - Dapoer Tabi</title>
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
<h2 class="review-title">Edit Profile</h2>

    <form class="profile-form" 
          action="{{ route('profile.update') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

      <div class="profile-avatar">
      @if($user->profile_photo)
          <img src="{{ asset('storage/'.$user->profile_photo) }}" width="80">
      @else
          <svg viewBox="0 0 24 24" width="80">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
      @endif
      </div>

      <div class="form-group-edit">
          <label>Profile Photo</label>
          <input type="file" name="profile_photo">
      </div>

      <div class="form-group-edit">
          <label>Name</label>
          <input type="text" name="name" value="{{ $user->name }}">
      </div>

      <div class="form-group-edit">
          <label>Email</label>
          <input type="email" name="email" value="{{ $user->email }}">
      </div>

      <div class="form-group-edit">
          <label>Phone</label>
          <input type="text" name="phone" value="{{ $user->phone }}">
      </div>

      <button type="submit" class="edit-button">
      Save Change
      </button>

</form>
</div>
</section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>