@extends('frontend.layout')
<link rel="stylesheet" href="{{ asset('css/.css') }}" />

@section('content')
<div class="container mt-5">
    <h2>Dashboard</h2>

    <!-- Bagian Navbar
    <nav class="navbar">
        <div class="nav-bar">
            <a href="#" class="logo"><img src="{{ asset('images/logo scnd.png') }}" alt=""></a>
            <input type="search" placeholder="Search Jersey...">
            <div class="nav-links">
                <a href="#" class="tab active">Wanita</a>
                <a href="#" class="tab active">Pria</a>
                <a href="#" class="tab active">Branded</a>
                <a href="#" class="tab active">Anak</a>
                <a href="#" class="sell-link">Jual</a>
                <div class="icons">
                    <a href="#"><img src="{{ asset('images/mail.png') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('images/cart[1].png') }}" alt=""></a>
                    <a href="#" class="profile-icon">C</a>
                </div>        
            </div>
        </div>
    </nav> -->

    <div class="dashboard">
        <aside class="sidebar">
            <div class="profile">
                <div class="avatar">U</div>
                <h2>User</h2>
                <p>@user123</p>
            </div>
            <a href="uploadproduk.html"><button>+ Upload produk</button></a>
            <nav>
                <ul>
                    <li><a href="{{ route('dashboard.index') }}">Overview</a></li>
                    <li><a href="Pesanan.html">Pesanan</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <header>
                <h1>Pesanan</h1>
                <p>Tidak ada pesanan</p>
            </header>
        </main>
    </div>
</div>
@endsection
