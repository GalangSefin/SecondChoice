@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/tentangkami.css') }}" />

<div class="container mt-5">
    <div class="about">
        <div class="content">
            <h2>Tentang Kami</h2>
            <p>Second Choice merupakan salah satu platform website yang memudahkan kamu untuk mencari barang bekas mahasiswa dengan kualitas yang baik di wilayah Jember.
                Kami memberikan kemudahan untuk kamu yang ingin membeli ataupun menjualkan barang-barang bekas mahasiswa.
                Second Choice dibentuk pada tahun 2024 dan percaya bahwa Second Choice dapat menjadi pilihan kamu untuk menciptakan hubungan yang berkelanjutan antara penjual dan pembeli.
            </p>
        </div>

        <div class="content">
            <h2>Tim Kami</h2>
            <p>Anggota kami yang berkomitmen untuk terus berkembang dan memberikan dampak positif bagi Second Choice dan penggunanya.
                Terima kasih telah mempercayai kami sebagai bagian dari perjalanan Anda😊
            </p>
        </div>
    </div>

    <section class="gallery">
        <div class="image-container">
            <img src="{{ asset('image/gbr 1.jpeg') }}" alt="Anggota 1">
            <p>Anggota 1</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 2.jpeg') }}" alt="Anggota 2">
            <p>Anggota 2</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 3.jpeg') }}" alt="Anggota 3">
            <p>Anggota 3</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 4.jpeg') }}" alt="Anggota 4">
            <p>Anggota 4</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 5.jpeg') }}" alt="Anggota 5">
            <p>Anggota 5</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 6.jpeg') }}" alt="Anggota 6">
            <p>Anggota 6</p>
        </div>
        <div class="image-container">
            <img src="{{ asset('image/gbr 7.jpeg') }}" alt="Anggota 7">
            <p>Anggota 7</p>
        </div>
    </section>
</div>

<!-- <footer>
    <p>&copy; 2024 Perusahaan Kami. Hak Cipta Dilindungi.</p>
</footer> -->
@endsection
