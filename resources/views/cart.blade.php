<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart - Dapoer Tabi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
</head>
<body class="detail-page"> 

  <!-- HEADER -->
  @include('layouts.header')  

  <section class="cart-section">
    <div class="cart-container">
       @if(empty($cart) || count($cart) == 0)

            <div class="cart-empty">
                <h3>Your cart is empty!</h3>
                <p>Please add a product first.</p>
            </div>
        @else

        @foreach($cart as $id => $item)
        <div class="cart-item" data-id="{{ $id }}">
            <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">

            <div class="cart-name">{{ $item['name'] }}</div>

            <div class="cart-price" data-price="{{ $item['price'] }}">
                Rp. {{ number_format($item['price'],0,',','.') }}
            </div>

            <div class="qty-box">
                <button class="qty-btn btn-minus">-</button>
                <span class="qty-value">{{ $item['qty'] }}</span>
                <button class="qty-btn btn-plus">+</button>
            </div>

            <div class="cart-total subtotal">
                Rp. {{ number_format($item['price'] * $item['qty'],0,',','.') }}
            </div>

            <form action="{{ route('cart.remove', $id) }}" method="POST" class="delete-form">
                @csrf
                <button type="button" class="delete-btn">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

        </div>
        @endforeach
    </div>

        </div>
    <!-- Total -->
    @php $total = 0 @endphp
      @foreach($cart as $item)
          @php $total += $item['price'] * $item['qty'] @endphp
      @endforeach

      <div class="cart-summary">
          <div>Subtotal</div>
          <div>Rp {{ number_format($total,0,',','.') }}</div>
      </div>

    <a href="{{ route('checkout.store') }}">
    <button class="order-btn">Proceed to Checkout</button>
    </a>
    @endif
  </section>

  <!-- FOOTER -->
  @include('layouts.footer')  

<script src="{{ asset('js/app.js') }}"></script>

<div id="confirm-popup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-exclamation-circle"></i>
    <h3>Are you sure you want to remove this item?</h3>
    <div class="mt-3 d-flex justify-content-center gap-2">
      <button id="confirm-yes" class="delete-cart-btn">Delete</button>
      <button id="confirm-no" class="no-delete-btn">Cancel</button>
    </div>
  </div>
</div>

<div id="delete-popup" class="cart-popup">
  <div class="popup-box">
    <i class="bi bi-trash"></i>
    <p>Product removed from cart 🗑️</p>
  </div>
</div>

<script>
document.querySelectorAll('.cart-item').forEach(item => {
    let id = item.dataset.id;

    let btnPlus = item.querySelector('.btn-plus');
    let btnMinus = item.querySelector('.btn-minus');
    let qtyEl = item.querySelector('.qty-value');
    let subtotalEl = item.querySelector('.subtotal');
    let price = parseInt(item.querySelector('.cart-price').dataset.price);

    function formatRupiah(number) {
        return 'Rp. ' + number.toLocaleString('id-ID');
    }

    function updateQty(newQty) {
        fetch(`/cart/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ qty: newQty })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                qtyEl.innerText = data.qty;
                subtotalEl.innerText = formatRupiah(data.subtotal);

                updateTotal(); // update total bawah
            }
        });
    }

    btnPlus.addEventListener('click', () => {
        let qty = parseInt(qtyEl.innerText);
        updateQty(qty + 1);
    });

    btnMinus.addEventListener('click', () => {
        let qty = parseInt(qtyEl.innerText);
        if (qty > 1) updateQty(qty - 1);
    });
});

// 🔥 UPDATE TOTAL SEMUA
function updateTotal() {
    let total = 0;

    document.querySelectorAll('.cart-item').forEach(item => {
        let qty = parseInt(item.querySelector('.qty-value').innerText);
        let price = parseInt(item.querySelector('.cart-price').dataset.price);

        total += qty * price;
    });

    document.querySelector('.cart-summary div:last-child').innerText =
        'Rp. ' + total.toLocaleString('id-ID');
}
</script>

</body>
</html>

