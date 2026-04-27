<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>
<body>

<div class="container text-center">
    <h3>Payment</h3>
    <p>Total: Rp {{ number_format($order->total,0,',','.') }}</p>

    <button id="pay-button" class="order-btn">
        Pay Now
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function () {
            window.location.href = "{{ route('history') }}";
        },
        onPending: function () {
            alert('Menunggu pembayaran');
        },
        onError: function () {
            alert('Pembayaran gagal');
        }
    });
});
</script>

</body>
</html>