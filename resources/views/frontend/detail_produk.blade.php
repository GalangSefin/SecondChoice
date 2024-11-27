@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/detail_produk.css') }}">

<div class="product-container">
    <!-- Bagian Gambar Produk -->
    <div class="product-image-container">
        <img id="mainImage" src="data:image/jpeg;base64,{{ base64_encode($products->images->first()->image) }}" alt="{{ $products->name }}" class="main-image">
        <div class="thumbnail-container">
            @foreach ($products->images as $image)
                <img src="data:image/jpeg;base64,{{ base64_encode($image->image) }}" alt="Thumbnail" class="thumbnail" onclick="changeImage('data:image/jpeg;base64,{{ base64_encode($image->image) }}')">
            @endforeach
        </div>
    </div>

    <!-- Bagian Detail Produk -->
    <div class="product-details">
        <h1>{{ $products->name }}</h1>
        <p class="condition">Kondisi: {{ $products->condition }}</p>
        <p class="price">Rp {{ number_format($products->price, 0, ',', '.') }}</p>

        <div class="product-info scrollable">
            <div class="product-description">
                {!! nl2br(e($products->description)) !!}
            </div>
        </div>

        <p class="jenis_nama"> {{ $products->namajenis->jenis_nama }}</p>
        <p class="category_nama"> {{ $products->namacategory->category_nama }}</p>

       <!-- Informasi Penjual -->
<div class="seller-info">
    <!-- Gambar Avatar Penjual -->
    @if($products->seller->avatar)
        <img src="data:image/jpeg;base64,{{ base64_encode($products->seller->avatar) }}" alt="Avatar Penjual" class="seller-avatar">
    @else
        <img src="{{ asset('default-avatar.jpg') }}" alt="Avatar Default" class="seller-avatar">
    @endif

          <!-- Detail Penjual -->
        <div class="seller-details">
          <a href="#">{{ $products->seller->name }}</a>
          <p>{{ $products->seller->location }}</p>
        </div>
      </div>



        <div class="product-buttons">
            <form action="{{ route('cart', $products->id) }}" method="POST">
                @csrf
                <button type="submit" class="buy-now">Beli Sekarang</button>
                <button type="button" class="add-to-cart">+ Tambahkan ke Keranjang</button>
            </form>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById("mainImage").src = imageUrl;
    }
</script>
@endsection
