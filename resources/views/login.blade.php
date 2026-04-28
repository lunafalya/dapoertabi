<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Dapoer Tabi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
      <h4 class="mb-3">Login</h4>
      <p class="text mb-4">Welcome back! We're happy to see you again. Log in to continue your delicious journey with Dapoer Tabi.</p>

      <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <input type="email" 
                    name="email"
                    class="form-control" 
                    placeholder="Email"
                    required>
            </div>

            <div class="mb-4 position-relative">
                <input type="password"
                    class="form-control password-field"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Password"
                    required>
                <i class="bi bi-eye toggle-password"></i>

            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" 
                        type="checkbox" 
                        name="remember"
                        id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-login">Login</button>
            </div>
        </form>

        <div class="login-footer mt-4">
            <p class="mb-1">
                Don't have an account? 
                <a href="{{ route('register') }}">Register</a>
            </p>
            <a href="{{ route('forgot-pw') }}">Forgot Password?</a>
        </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
