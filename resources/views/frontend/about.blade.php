@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <h1 class="text-white text-6xl font-bold">About Us</h1>
    </div>
</div>

<!-- Our Story Section -->
<div class="bg-white py-16 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Text Content -->
        <div>
            <h2 class="text-3xl font-bold mb-4 text-gray-900">Tentang Kami</h2>
            <p class="text-gray-700 leading-relaxed" style="text-align: justify;">
            Second Choice merupakan salah satu platform website yang memudahkan kamu untuk mencari barang bekas mahasiswa dengan kualitas yang baik di wilayah Jember.
            Kami memberikan kemudahan untuk kamu yang ingin membeli ataupun menjualkan barang-barang bekas mahasiswa.
            Second Choice dibentuk pada tahun 2024 dan percaya bahwa Second Choice dapat menjadi pilihan kamu untuk menciptakan hubungan yang berkelanjutan antara penjual dan pembeli😊
            </p>
        </div>
        <!-- Image -->
        <div>
            <img 
                alt="Image of a clothing rack with clothes and a plant" 
                class="w-full h-auto rounded-lg shadow-lg" 
                src="images/logo-bg-putih.jpeg" 
            />
        </div>
    </div>
</div>

<!-- Call to Action -->
<div style="background-color: #870017;" class="py-8">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-white mb-4">Mari Bergabung Dengan Kami</h2>
        <p class="text-white text-lg mb-8">
            Temukan kisah di balik misi kami dan jadilah bagian dari sesuatu yang lebih besar. Let’s grow together!✨
        </p>
        <a 
            href="{{ route('jual') }}" 
            style="color: #870017;" 
            class="bg-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
            Mulai Jualan
        </a>

    </div>
</div>
@endsection
