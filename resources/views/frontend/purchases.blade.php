@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/purchases.css') }}" />

<div class="container">
    <h1 class="title">Purchases</h1>

    <!-- First Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('images/croptop.jpg') }}" alt="Crop Top">
        </div>
        <div class="details">
            <h2>Crop Top</h2>
            <p>Size M, White</p>
            <p>Rp45.000</p>
            <p>Total: Rp50.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-received">Pesanan Diterima</button>
        </div>
    </div>

    <!-- Second Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('images/galon.jpeg') }}" alt="Galon Aqua">
        </div>
        <div class="details">
            <h2>Galon Aqua</h2>
            <p>Blue, 19 Liter</p>
            <p>Rp28.000</p>
            <p>Total: Rp33.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-shipped">Dikirim</button>
        </div>
    </div>

    <!-- Third Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('images/kulkas.jpg') }}" alt="Kulkas Bekas">
        </div>
        <div class="details">
            <h2>Kulkas Bekas</h2>
            <p>Abu-abu, size L</p>
            <p>Rp989.900</p>
            <p>Total: Rp994.900</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-received">Pesanan Diterima</button>
        </div>
    </div>

    <!-- Fourth Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('images/celana.jpg') }}" alt="Celana">
        </div>
        <div class="details">
            <h2>Celana Pendek Jeans</h2>
            <p>Biru-Abu, size L</p>
            <p>Rp30.000</p>
            <p>Total: Rp35.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-shipped">Dikemas</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/purchases.js') }}"></script>
@endsection
