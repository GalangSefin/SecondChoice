@extends('frontend.layout')
<link rel="stylesheet" href="{{ asset('css/jual.css') }}" />

@section('content')
<div class="dashboard container mt-5">
    <aside class="sidebar">
        <div class="profile">
            <div class="avatar">U</div>
            <h2>User</h2>
            <p>@user123</p>
        </div>
        <a href="{{ url('uploadproduk') }}"><button>+ Upload produk</button></a>
        <nav>
            <ul>
            <li><a href="{{ route('dashboard.index') }}">Overview</a></li>
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
            <p>Tidak ada produk <a href="{{ url('uploadproduk') }}">Tambahkan Produk</a>.</p>
        </section>
    </main>
</div>
@endsection
