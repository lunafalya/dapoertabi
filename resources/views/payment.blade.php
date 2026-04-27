<div class="container text-center">

<h3>Payment QRIS / Gopay</h3>

<p>Total:
Rp {{ number_format($order->total,0,',','.') }}
</p>

<img src="{{ asset('images/qrcode.jpeg') }}" width="250">

<form action="{{ route('payment.upload',$order->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mt-3">
<label>Upload Bukti Transfer</label>
<input type="file" name="proof" required class="form-control">
</div>

<button class="btn btn-success mt-3">
Kirim Bukti Transfer
</button>

</form>

</div>