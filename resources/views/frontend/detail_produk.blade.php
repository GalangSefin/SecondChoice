@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/jual.css') }}">
<link rel="stylesheet" href="{{ asset('second_choice/css/detail_produk.css') }}">

<div class="container mx-auto px-4 py-8">
    <div class="product-container">
        <!-- Bagian Gambar Produk -->
        <div class="product-image-container">
            @if ($product->images->isNotEmpty())
                <img id="mainImage" 
                    src="{{ $product->images->first()->decoded_image }}" 
                    alt="{{ $product->name }}" 
                    class="main-image">
                <div class="thumbnail-container">
                    @foreach ($product->images as $image)
                        <img src="{{ $image->decoded_image }}" 
                            alt="Thumbnail" 
                            class="thumbnail" 
                            onclick="changeImage('{{ $image->decoded_image }}')">
                    @endforeach
                </div>
            @else
                <img src="{{ asset('second_choice/images/no-image.png') }}" 
                    alt="No Image" 
                    class="main-image">
            @endif
        </div>

        <!-- Bagian Detail Produk -->
        <div class="product-details">
            <h1 class="product-name">{{ $product->name }}</h1>
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

            <!-- Informasi Penjual -->
            <div class="seller-info">
                @if($product->seller)
                    <!-- Gambar Avatar Penjual -->
                    @if($product->seller->avatar)
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->seller->avatar) }}" 
                            alt="Avatar Penjual" 
                            class="seller-avatar">
                    @else
                        <img src="{{ asset('second_choice/images/default-avatar.jpg') }}" 
                            alt="Avatar Default" 
                            class="seller-avatar">
                    @endif

                    <!-- Detail Penjual -->
                    <div class="seller-details">
                        <h3>{{ $product->seller->name }}</h3>
                        @if($product->seller->location)
                            <p>{{ $product->seller->location }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="product-buttons">
    <form action="{{ route('keranjang.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit" name="action" value="add-to-cart" class="btn btn-primary add-to-cart">+ Tambahkan ke Keranjang</button>
    </form>
    <a href="{{ route('checkout') }}" class="btn btn-success buy-now">Beli Sekarang</a>
</div>

        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById("mainImage").src = imageUrl;
    }
</script>
@endsection