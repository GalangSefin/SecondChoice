@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/jual.css') }}">

<div class="container mt-5">

    <main>
        <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<nav aria-label="Breadcrumb">
    <ol class="flex items-center gap-1 text-sm text-gray-600">
      <li>
        <a href="http://127.0.0.1:8000/home" class="block transition hover:text-gray-700">
          <span class="sr-only"> Home </span>
  
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
            />
          </svg>
        </a>
      </li>
  
      <li class="rtl:rotate-180">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="size-4"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd"
          />
        </svg>
      </li>
  
      <li>
        <a href="http://127.0.0.1:8000/products" class="block transition hover:text-gray-700"> Produk </a>
      </li>
  
      
  </nav>
        <h2>Halaman Produk</h2>
        <div class="filters">
            <button>Ele</button>
            <button>Outerwear</button>
            <button>Bottoms</button>
            <button>Accessories</button>
            <button>Footwear</button>
            <button>Underwear</button>
        </div>

        <div class="sorting">
            <form action="{{ route('products.viewall') }}" method="GET">
                <!-- Filter Kategori -->
                <select name="category" onchange="this.form.submit()">
    <option value="">Pilih Kategori</option>
    @foreach($categories as $category)
        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
            {{ $category }}
        </option>
    @endforeach
</select>

                <!-- Filter Harga -->
                <select name="price" onchange="this.form.submit()">
                    <option value="">Harga</option>
                    <option value="under_50000" {{ request('price') == 'under_50000' ? 'selected' : '' }}>Di bawah Rp 50,000</option>
                    <option value="50k_100k" {{ request('price') == '50k_100k' ? 'selected' : '' }}>Rp 50,000 - Rp 100,000</option>
                    <option value="100k_200k" {{ request('price') == '100k_200k' ? 'selected' : '' }}>Rp 100,000 - Rp 200,000</option>
                    <option value="above_200k" {{ request('price') == 'above_200k' ? 'selected' : '' }}>Di atas Rp 250,000</option>
                </select>

                <!-- Filter Kondisi -->
                <select name="condition" onchange="this.form.submit()">
                    <option value="">Kondisi</option>
                    <option value="New" {{ request('condition') == 'New' ? 'selected' : '' }}>Baru</option>
                    <option value="Good" {{ request('condition') == 'Good' ? 'selected' : '' }}>Bagus</option>
                    <option value="Used" {{ request('condition') == 'Used' ? 'selected' : '' }}>Bekas</option>
                </select>

                <!-- Pilihan Sortir -->
                <select name="sort" onchange="this.form.submit()">
                    <option value="">Sortir</option>
                    <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="highest_price" {{ request('sort') == 'highest_price' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>
            </form>
        </div>

        <!-- <h1>Daftar Semua Produk</h1>
    <form action="{{ route('products.viewall') }}" method="GET">
        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    @if($products->isNotEmpty())
        <ul>
            @foreach($products as $item)
                <li>{{ $item->name }} - {{ $item->category }}</li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada produk ditemukan.</p>
    @endif -->
        <!-- Menggunakan ul dan li untuk tampilan produk -->
        <ul class="grid">
            @forelse($products as $product)
                <li class="product-item">
                    <div class="product-image">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ $product->images->first()->decoded_image }}" 
                                 alt="{{ $product->name }}"
                        @else
                            <img src="{{ asset('second_choice/images/no-image.png') }}" alt="No Image">
                        @endif
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-detail">Lihat Detail</a>
                    </div>
                </li>
            @empty
                <li class="no-items">
                    <img src="{{ asset('second_choice/images/eyes.png') }}" alt="No Items">
                    <p>Tidak ada produk yang ditemukan.</p>
                </li>
            @endforelse
        </ul>

    </main>
</div>
@endsection
