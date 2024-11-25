@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/profile.css') }}" />
<div class="container mt-5">
    <h2>Profile Pengguna</h2>

    <!-- Bagian Profile Section -->
    <section class="profile-section">
        <div class="profile-header">
        <div class="profile">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <h2>{{ Auth::user()->name }}</h2>
            <!-- <p>@{{ Auth::user()->username }}</p> -->
            <a href="{{ route('settings') }}">
                    <button class="edit-profile">Edit profil</button>
                </a>
            </div>

            
        </div>

        Bagian Informasi Profile Detail
    <div class="profile-details mt-4">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    </div>

        <!-- Bagian Tab Menu -->
<footer>
    <div class="tabs">
        <a href="#" class="tab active">Listings</a>
        <a href="#" class="tab">Reviews</a>
    </div>

    <!-- Bagian Listings Produk -->
    <div id="listings-content">
        @if ($products->isEmpty())
            <div class="no-items">
                <img src="{{ asset('second_choice/images/eyes.png') }}" alt="Eyes Icon">
                <p>Belum ada item</p>
            </div>
        @else
            <div class="listings">
                @foreach ($products as $product)
                    <div class="listing-item">
                        <div class="listing-image">
                            @if ($product->images->isNotEmpty())
                            <img src="data:image/jpeg;base64,{{ base64_encode($product->images->first()->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('second_choice/images/no-image.png') }}" alt="No Image">
                            @endif
                        </div>
                        <div class="listing-info">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p><strong>Stok:</strong> {{ $product->stock }}</p>
                            <p><strong>Kondisi:</strong> {{ $product->condition === 'new' ? 'Barang Baru' : 'Barang Bekas' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
             <!-- Pagination Controls -->
             <div class="pagination">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
        @endif
    </div>
</footer>
    </section>
    </div>
@endsection