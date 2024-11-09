@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/profile.css') }}" />
<div class="container mt-5">
    <h2>Profile Pengguna</h2>

    <!-- Bagian Profile Section -->
    <section class="profile-section">
        <div class="profile-header">
            <div class="profile-icon-large">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="profile-info">
                <h1>{{ Auth::user()->name }}</h1>
                <p>@{{ Auth::user()->username }}</p>
                <a href="{{ route('settings') }}">
                    <button class="edit-profile">Edit profil</button>
                </a>
                
            </div>
        </div>

        <!-- Bagian Tab Menu -->
        <footer>
            <div class="tabs">
                <a href="#" class="tab active">Listings</a>
                <a href="#" class="tab">Reviews</a>
            </div>
        </footer>

        <!-- Bagian Jika Belum Ada Item -->
        <div class="no-items">
            <img src="{{ asset('second_choice/images/eyes.png') }}" alt="Eyes Icon">
            <p>Belum ada item</p>
        </div>
    </section>

    <!-- Bagian Informasi Profile Detail -->
    <!-- <div class="profile-details mt-4">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    </div> -->

    <!-- Bagian Tindakan Profile -->
    <!-- <div class="profile-actions">
        <a href="{{ route('settings') }}" class="btn btn-primary">Edit Profile</a>
        <a href="{{ route('logout') }}" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
            Logout
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

  </div> -->
@endsection