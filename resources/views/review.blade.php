<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="solid-nav">
  <!-- HEADER -->
  @include('layouts.header')  

<section class="review-page-container">
    <div class="review-content">
        
        <h2 class="review-title">Add Review</h2>

        <form method="POST" action="{{ route('review.store') }}" class="review-form" id="reviewForm">
        @csrf

        <input type="hidden" name="checkout_id" value="{{ $checkout->id }}">
        <input type="hidden" name="rating" id="ratingValue"> <!-- tidak ada default -->

        <!-- RATING -->
        <div class="form-group-edit">
            <label>Rating</label>
            <div class="rating-stars" id="starRating">
                @for($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">★</span>
                @endfor
            </div>
        </div>

        <!-- PRODUCT -->
        <div class="form-group-edit">
            <label>Product</label>
            <input type="text"
                  value="{{ $checkout->product->name }}"
                  readonly>
        </div>

        <!-- REVIEW -->
        <div class="form-group-edit">
            <label>Review</label>
            <textarea name="review" rows="6"
                placeholder="Add your review..."
                required></textarea>
        </div>

        <button type="submit" class="edit-button">Submit Review</button>
    </form>

    </div>
</section>

<!-- FOOTER -->
@include('layouts.footer')

<script src="{{ asset('js/app.js') }}"></script>
<script>
// ⭐ HANDLE CLICK STAR
const stars = document.querySelectorAll('#starRating .star');
const ratingInput = document.getElementById('ratingValue');

stars.forEach(star => {
    star.addEventListener('click', function() {
        let value = this.getAttribute('data-value');
        ratingInput.value = value;

        // reset warna
        stars.forEach(s => s.classList.remove('active'));

        // kasih warna sampai bintang yg dipilih
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.classList.add('active');
            }
        });
    });
});

// 🚨 VALIDASI SUBMIT
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    if (!ratingInput.value) {
        e.preventDefault();
        alert("Silakan pilih rating bintang terlebih dahulu!");
    }
});
</script>

</body>
</html>