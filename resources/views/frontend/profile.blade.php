@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/profile.css') }}" />
<div class="container mt-5">

    <!-- Bagian Profile Section -->
    <section class="profile-section">
        <div class="profile-header">
        <h2>Profile Pengguna</h2>
        <div class="profile">
            <div class="avatar">
                @if($user->profile_picture)
                    @php
                        $base64Content = Storage::get('public/profile_pictures/' . $user->profile_picture);
                    @endphp
                    <img src="data:image/jpeg;base64,{{ $base64Content }}" 
                         alt="Profile Picture"
                         class="profile-image">
                @else
                    <div class="avatar-placeholder">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                @if($user->bio)
                    <p>{{ $user->bio }}</p>
                @endif
                @if($user->phone_number)
                    <p><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                @endif
                @if($user->website)
                    <p><i class="fas fa-globe"></i> {{ $user->website }}</p>
                @endif
                @if($user->alamat)
                    <p><i class="fas fa-map-marker-alt"></i> {{ $user->alamat }}</p>
                @endif

                @if(Auth::id() == $user->id)
                    <div class="edit-profile-btn">
                        <a href="{{ route('settings') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <strong>Bagian Informasi Profile Detail</strong>
    <div class="profile-details mt-4">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
        <p><strong>Bio:</strong> {{ Auth::user()->bio }}</p>
        <p><strong>No. Telp:</strong> {{ Auth::user()->phone_number }}</p>
        <p><strong>Website:</strong> <a href="{{ Auth::user()->website }}" target="_blank">{{ Auth::user()->website }}</a></p>
        <p><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
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
                @php
                    $decodedImage = $product->images->first()->decoded_image ?? null;
                @endphp

                @if ($decodedImage)
                    <!-- Menampilkan gambar hasil dekripsi -->
                    <img src="{{ $decodedImage }}" alt="{{ $product->name }}">
                @else
                    <!-- Fallback jika decoding gagal -->
                    <img src="{{ asset('second_choice/images/no-image.png') }}" alt="No Image">
                @endif
            @else
                <!-- Fallback jika produk tidak memiliki gambar -->
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