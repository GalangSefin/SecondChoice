@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/profile.css') }}" />
<div class="container mt-5">
    <div class="profile-container">
        <!-- Bagian Kiri - Informasi Profil -->
        <div class="profile-left-section">
            <div class="profile-card">
                <div class="profile-header">
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
                        <h2 class="user-name">{{ $user->name }}</h2>
                        @if($user->bio)
                            <p class="user-bio">{{ $user->bio }}</p>
                        @endif
                    </div>

                    @if(Auth::id() == $user->id)
                        <div class="edit-profile-btn">
                            <a href="{{ route('settings') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        </div>
                    @endif
                </div>

                <div class="contact-info">
                    @if($user->phone_number)
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <span>{{ $user->phone_number }}</span>
                        </div>
                    @endif
                    @if($user->website)
                        <div class="info-item">
                            <i class="fas fa-globe"></i>
                            <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                        </div>
                    @endif
                    @if($user->alamat)
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $user->alamat }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bagian Kanan - Listings dan Reviews -->
        <div class="profile-right-section">
            <div class="content-tabs">
                <div class="tabs">
                    <a href="#listings" class="tab active" data-tab="listings">
                        <i class="fas fa-store"></i> Listings
                    </a>
                    <a href="#reviews" class="tab" data-tab="reviews">
                        <i class="fas fa-star"></i> Reviews
                    </a>
                </div>

                <div id="listings-content" class="tab-content active">
                    @if ($products->isEmpty())
                        <div class="no-items">
                            <img src="{{ asset('second_choice/images/eyes.png') }}" alt="Eyes Icon">
                            <p>Belum ada item</p>
                        </div>
                    @else
                        <div class="listings-grid">
                            @foreach ($products as $product)
                                <div class="product-card">
                                    <div class="product-image">
                                        @if ($product->images->isNotEmpty())
                                            <img src="{{ $product->images->first()->decoded_image ?? asset('second_choice/images/no-image.png') }}" 
                                                 alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('second_choice/images/no-image.png') }}" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <h3>{{ $product->name }}</h3>
                                        <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                        <div class="product-meta">
                                            <span class="stock">Stok: {{ $product->stock }}</span>
                                            <span class="condition">{{ $product->condition === 'new' ? 'Baru' : 'Bekas' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-container">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection