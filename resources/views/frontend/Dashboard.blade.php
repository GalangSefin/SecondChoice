@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/dashboard.css') }}" />

<nav class="navbar">
    <div class="nav-bar">
        <a href="#" class="logo"><img src="{{ asset('second_choice/images/logo scnd.png') }}" alt="Logo Second Choice"></a>
        <input type="search" placeholder="Search Jersey...">
        <div class="nav-links">
            <a href="#" class="tab active">Wanita</a>
            <a href="#" class="tab active">Pria</a>
            <a href="#" class="tab active">Branded</a>
            <a href="#" class="tab active">Anak</a>
            <a href="#" class="sell-link">Jual</a>
            <div class="icons">
                <a href="#"><img src="{{ asset('second_choice/images/mail.png') }}" alt="Mail Icon"></a>
                <a href="#"><img src="{{ asset('second_choice/images/cart[1].png') }}" alt="Cart Icon"></a>
                <a href="#" class="profile-icon">{{ substr(Auth::user()->name, 0, 1) }}</a>
            </div>
        </div>        
    </div>
</nav>

<div class="dashboard">
    <aside class="sidebar">
        <div class="profile">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <h2>{{ Auth::user()->name }}</h2>
            <p>@{{ Auth::user()->username }}</p>
        </div>
        <a href="{{ route('produk.upload') }}"><button>+ Upload produk</button></a>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Overview</a></li>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <header>
            <h1>Selamat Datang</h1>
            <p>Berikut status pendapatanmu</p>
        </header>
        
        <section class="status">
            <div class="status-item">
                <p>Total pendapatan</p>
                <p>Rp 0</p>
            </div>
            <div class="status-item">
                <p>Produk terjual</p>
                <p>0</p>
            </div>
        </section>

        <section class="orders">
            <h2>Pesanan</h2>
            <p>Belum ada barang yang terjual</p>
        </section>

        <section class="listings">
            <h2>Daftar</h2>
            <p>Tidak ada produk <a href="{{ route('produk.upload') }}">Tambahkan Produk</a>.</p>
        </section>
    </main>
</div>
@endsection
