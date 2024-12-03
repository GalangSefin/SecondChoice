@extends('frontend.layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="relative">
    <img src="images/bg.jpg" alt="Deskripsi gambar" class="w-full h-96 object-cover"  />

    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <h1 class="text-white text-6xl font-bold">Tata Cara</h1>
    </div>
</div>

<body class="bg-white text-gray-900">
    <!-- Bagian Cara Jual -->
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8 text-center">
            Cara Jual Barangmu Sendiri
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center">
                <img alt="Character taking a photo of clothes on a rack" class="rounded-lg mb-4" src="https://storage.googleapis.com/a1aa/image/xfBd24kHpzT5e0FN1LcCaVzR22aeqxJm0BsSsqD9DDAqmDpnA.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    1. Upload produk
                </h2>
                <p class="text-center text-gray-700">
                    Foto barang yang akan dijual, deskripsikan, dan tentukan harganya.
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Character packing a box for shipping" class="rounded-lg mb-4" src="https://storage.googleapis.com/a1aa/image/kTH0GRe5rz2BRaBtHwlDkU9O0yQAi9BxPqoKHCnVXKZr5Q6JA.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    2. Jual dan kirim
                </h2>
                <p class="text-center text-gray-700">
                    Barangmu terjual! Cetak label pengiriman dan kirim paketmu sebelum batas waktu seminggu.
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Character holding money" class="rounded-lg mb-4" src="https://storage.googleapis.com/a1aa/image/rZbhKeTKfnsrOkvcxAFSuGMteRBULpdUohT4jsdfSAwTNHSPB.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    3. Hasilkan Uang
                </h2>
                <p class="text-center text-gray-700">
                    Kamu akan dibayar setelah pembeli mengonfirmasi penerimaan paket.
                </p>
            </div>
        </div>
        <div class="flex justify-center mt-8">
            <button class="bg-black text-white text-lg py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300">
                Mulai Berjualan
            </button>
        </div>
    </div>

    <!-- Spasi pemisah -->
    <div class="my-16 border-t border-gray-300"></div>

    <!-- Bagian Cara Belanja -->
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8 text-center">
            Cara Belanja
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                <img alt="Cartoon character searching for products online" class="w-full mb-4 rounded-lg" src="https://storage.googleapis.com/a1aa/image/HQ6difQY1nwrQCWq31Weg1NtoGUucszTIzD5FfFEYaSZvDpnA.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    1. Temukan Produk
                </h2>
                <p class="text-gray-700">
                    Temukan produk sesuai budget dan keinginanmu.
                </p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                <img alt="Cartoon character chatting with a seller online" class="w-full mb-4 rounded-lg" src="https://storage.googleapis.com/a1aa/image/0uMxHbGzq1pHPBAbx5HO4wzA8fAU7fEpC0RYTEAEBCIp3h0TA.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    2. Beli
                </h2>
                <p class="text-gray-700">
                    Tanyakan ketersediaan barang, lalu klik 
                    <strong>Beli Sekarang</strong>. Bayar dengan aman melalui QRIS atau bank favoritmu.
                </p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                <img alt="Cartoon character receiving products with stars around" class="w-full mb-4 rounded-lg" src="https://storage.googleapis.com/a1aa/image/WaMgYuVNSNIoC57kJHVeH6W0eEWEG0Qd57I5pUC6D2nq3h0TA.jpg" />
                <h2 class="text-xl font-bold mb-2">
                    3. Produk Diterima!
                </h2>
                <p class="text-gray-700">
                    Cek status pengiriman melalui aplikasi Preloved. Kami akan memberimu notifikasi saat paket dikirim.
                </p>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="bg-black text-white text-lg py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300">
                Shop Now
            </button>
        </div>
    </div>
@endsection
