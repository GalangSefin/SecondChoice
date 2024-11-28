@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/detail_produk.css') }}">

<div class="product-container">
    <!-- Bagian Gambar Produk -->
    <div class="product-image-container">
        <img id="mainImage" src="{{ $product->images->first()->decoded_image }}" alt="{{ $product->name }}" class="main-image">
        <div class="thumbnail-container">
            @foreach ($product->images as $image)
                <img src="{{ $image->decoded_image }}" alt="Thumbnail" class="thumbnail" onclick="changeImage('{{ $image->decoded_image }}')">
            @endforeach
        </div>
    </div>

    <!-- Bagian Detail Produk -->
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <p class="condition">Kondisi: {{ $product->condition }}</p>
        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

        <div class="product-info scrollable">
            <div class="product-description">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>

        @if($product->namajenis)
            <p class="jenis_nama">{{ $product->namajenis->jenis_nama }}</p>
        @endif

        @if($product->namacategory)
            <p class="category_nama">{{ $product->namacategory->category_nama }}</p>
        @endif

        <!-- Tambahkan ini untuk debugging -->
        @if(config('app.debug'))
            <div style="display:none">
                Debug Info:
                <pre>
                    Jenis ID: {{ $product->jenis }}
                    Category ID: {{ $product->category }}
                    Jenis Relation: {{ var_export($product->namajenis) }}
                    Category Relation: {{ var_export($product->namacategory) }}
                </pre>
            </div>
        @endif

        <!-- Informasi Penjual -->
        <div class="seller-info">
            <!-- Gambar Avatar Penjual -->
            @if($product->seller->avatar)
            <img src="data:image/jpeg;base64,{{ base64_encode($product->seller->avatar) }}" alt="Avatar Penjual" class="seller-avatar">
            @else
            <img src="{{ asset('default-avatar.jpg') }}" alt="Avatar Default" class="seller-avatar">
            @endif

            <!-- Detail Penjual -->
            <div class="seller-details">
                <a href="#">{{ $product->seller->name }}</a>
                <p>{{ $product->seller->location }}</p>
            </div>
        </div>

        <div class="product-buttons">
            @if(auth()->check() && auth()->id() !== $product->user_id)
                <!-- Tombol hanya muncul jika user login dan bukan pemilik produk -->
                <form action="{{ route('cart', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="buy-now">Beli Sekarang</button>
                    <button type="button" class="add-to-cart">+ Tambahkan ke Keranjang</button>
                </form>
                <a href="{{ route('messages.with.seller', $product->user_id) }}" class="contact-seller">
                    <button type="button" class="message-btn">Hubungi Penjual</button>
                </a>
            @elseif(!auth()->check())
                <!-- Jika belum login, arahkan ke halaman login -->
                <a href="{{ route('login') }}" class="login-first">
                    <button type="button" class="buy-now">Login untuk Membeli</button>
                </a>
            @endif
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById("mainImage").src = imageUrl;
    }
</script>
@endsection