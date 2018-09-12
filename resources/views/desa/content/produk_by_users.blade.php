@if($data)
    @foreach($data as $produk)
    <h1>Produk {{ $produk->nama }}</h1>

    @endforeach
@else
<p>Belum Ada Data</p>
@endif