@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/jual.css') }}">

<div class="container mt-5">

    <main>
        <div class="breadcrumb">
            <a href="#">Home</a> > <span>Baju Vintage Pria</span>
        </div>
        <h2>Baju Vintage Pria</h2>
        <p class="product-count">30,204 barang</p>
        <div class="filters">
            <button>Tops</button>
            <button>Outerwear</button>
            <button>Bottoms</button>
            <button>Accessories</button>
            <button>Footwear</button>
            <button>Underwear</button>
        </div>

        <div class="sorting">
            <select>
                <option>Category</option>
                <option>Perabotan</option>
                <option>Pakaian</option>
                <option>Elektronik</option>
                <option>Aksesoris</option>
                <option>Perkakas</option>
            </select>
            <select>
                <option>Size</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
                <option>XXL</option>
            </select>
            <select>
                <option>Color</option>
                <option>Red</option>
                <option>Blue</option>
                <option>Green</option>
                <option>Black</option>
                <option>White</option>
            </select>
            <select>
                <option>Brand</option>
                <option>Nike</option>
                <option>Adidas</option>
                <option>Levi's</option>
                <option>Puma</option>
                <option>Gucci</option>
            </select>
            <select>
                <option>Price</option>
                <option>Under Rp 50,000</option>
                <option>Rp 50,000 - Rp 100,000</option>
                <option>Rp 100,000 - Rp 200,000</option>
                <option>Above Rp 200,000</option>
            </select>
            <select>
                <option>Condition</option>
                <option>New</option>
                <option>Good</option>
                <option>Used</option>
            </select>
            <select>
                <option>Sortir</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
                <option>Newest</option>
                <option>Oldest</option>
            </select>
        </div>

        <h1>Daftar Semua Produk</h1>
    <form action="{{ route('home') }}" method="GET">
        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    @if($produk->isNotEmpty())
        <ul>
            @foreach($produk as $item)
                <li>{{ $item->name }} - {{ $item->category }}</li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada produk ditemukan.</p>
    @endi
        <!-- Menggunakan ul dan li untuk tampilan produk -->
        <ul class="grid">
            <li>
                <img src="{{ asset('second_choice/images/ansel.jpg') }}" alt="Product 1">
                <p class="price">Rp 140,000</p>
                <p class="brand">Marvel</p>
                <p class="size">M</p>
            </li>
            <li>
                <img src="{{ asset('second_choice/images/dino.png') }}" alt="Product 2">
                <p class="price">Rp 150,000</p>
                <p class="brand">Nike</p>
                <p class="size">M</p>
            </li>
            <li>
                <img src="{{ asset('second_choice/images/kuning.jpg') }}" alt="Product 3">
                <p class="price">Rp 130,000</p>
                <p class="brand">Adidas</p>
                <p class="size">L</p>
            </li>
            <li>
                <img src="{{ asset('second_choice/images/flanel.jpg') }}" alt="Product 4">
                <p class="price">Rp 120,000</p>
                <p class="brand">Levi's</p>
                <p class="size">S</p>
            </li>
            <!-- Tambahkan produk lainnya sesuai kebutuhan -->
        </ul>
    </main>
</div>
@endsection
