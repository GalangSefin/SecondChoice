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
    <form action="{{ route('ViewAll') }}" method="GET">
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
    @if ($products->isEmpty())
        <li class="no-items">
            <img src="{{ asset('second_choice/images/eyes.png') }}" alt="Eyes Icon">
            <p>Belum ada item</p>
        </li>
    @else
        @foreach ($products as $product)
            <li class="product-item">
                <div class="product-image">
                    @if ($product->images->isNotEmpty())
                        <!-- Gambar dari database -->
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->images->first()->image) }}" alt="{{ $product->name }}">
                    @else
                        <!-- Gambar default jika tidak ada -->
                        <img src="{{ asset('second_choice/images/no-image.png') }}" alt="No Image">
                    @endif
                </div>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p><strong>Kondisi:</strong> {{ $product->condition === 'new' ? 'Barang Baru' : 'Barang Bekas' }}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
<!-- Pagination Controls -->
<div class="pagination">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
    </main>
</div>
@endsection
