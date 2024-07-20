<h1>Order Berhasil Dibuat</h1>
<p>Detail Order:</p>
<ul>
    @foreach($orderData as $key => $value)
        <li>{{ $key }}: {{ $value }}</li>
    @endforeach
</ul>