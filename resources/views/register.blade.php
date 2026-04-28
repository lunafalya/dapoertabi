<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Dapoer Tabi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="login-wrapper">
  <div class="login-container shadow-lg">
    <div class="login-left">      
    </div>

    <div class="login-right">
      <h4 class="mb-3">Register</h4>
      <p class="text mb-4">Create your account and start enjoying the delicious flavors of Dapoer Tabi.</p>

      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif

      @if($errors->any())
      <div class="alert alert-danger">
          {{ $errors->first() }}
      </div>
      @endif

      <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
        </div>

        <div class="mb-3 position-relative">
            <input type="password"
              class="form-control password-field"
              name="password"
              autocomplete="new-password"
              placeholder="Password"
              required>
            <i class="bi bi-eye toggle-password"></i>
        </div>

        <div class="mb-3 position-relative">
          <input type="password"
            class="form-control password-field"
            name="password_confirmation"
            autocomplete="new-password"
            placeholder="Confirm Password"
            required>
            <i class="bi bi-eye toggle-password"></i>
        </div>

        <div class="mb-3">
          <label for="profile_picture" class="form-label file-label">Upload profile picture</label>
          <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-login w-100 py-2">Register</button>
      </form>

      <div class="login-footer mt-4 text-center">
        <p class="mb-1">Already have an account? <a href="{{ url('/login') }}">Login</a></p>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
