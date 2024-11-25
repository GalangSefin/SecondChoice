@extends('frontend.layout')

@section('content')
<!-- Link CSS untuk halaman checkout -->
<link rel="stylesheet" href="{{ asset('css/stylecheckout.css') }}">

<div class="wrapper">
    <!-- Header -->
    <header>
        <!-- Konten header bisa disesuaikan atau ditambahkan sesuai kebutuhan -->
    </header>

    <!-- Main Container -->
    <main class="container">
        <div class="row">
            <!-- Alamat Section -->
            <div class="col-md-6">
                <h4>Alamat</h4>
                <div class="card p-3">
                    <p><strong>Eki Nanda (Jember Mini Zoo)</strong></p>
                    <p>087765959541</p>
                    <p>Jl. Brawijaya, Kompleks RedjoAgung, Tanjung, Mangli, Kaliwates, Jember Regency, East Java 68131, Indonesia</p>
                    <a href="#" class="btn btn-link">Edit Alamat</a>
                </div>
            </div>

            <!-- Order Section -->
            <div class="col-md-6">
                <h4>Order</h4>
                <div class="card p-3">
                    <div class="d-flex justify-content-between">
                        <p><strong>Madness Stuff</strong></p>
                        <span class="badge bg-primary">⭐ 4.8</span>
                    </div>
                    <p>Vintage Streetwear T-shirt Pria gray XXL</p>
                    <div class="d-flex justify-content-between">
                        <p>Harga</p>
                        <p>Rp 250.000</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Pengiriman</p>
                        <p>Di tahap selanjutnya</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>Rp 250.000</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Pengiriman Section -->
            <div class="col-md-6">
                <h4>Pengiriman</h4>
                <div class="card p-3">
                    <select class="form-select">
                        <option selected>Pilih metode pengiriman</option>
                        <option value="1">JNE</option>
                        <option value="2">J&T</option>
                        <option value="3">SiCepat</option>
                    </select>
                </div>
            </div>

            <!-- Pilih Pembayaran -->
            <div class="col-md-6 d-flex align-items-end">
                <button class="btn btn-primary w-100">Pilih Pembayaran</button>
            </div>
        </div>
        <div class="text-center mt-3">
            <small class="text-muted">✔ Aman dengan Garansi Pembelian Preloved</small>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <!-- Konten footer -->
        <p>&copy; 2024 Second Choice. All rights reserved.</p>
    </footer>
</div>
@endsection
