<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Dapoer Tabi</title>
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
      <h4 class="mb-3">Reset Password</h4>
      <p class="text mb-4">Please enter your new password below.</p>

      <form action="" method="POST" enctype="multipart/form-data">
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

        <button type="submit" class="btn btn-login w-100 py-2">Reset</button>
      </form>

    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
