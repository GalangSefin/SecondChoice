@extends('frontend.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Keranjang Belanja</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (!empty($cart))
        @foreach ($cart as $item)
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img 
                            src="{{ $item['image'] }}" 
                            alt="{{ $item['name'] }}" 
                            class="w-20 h-20 object-cover mr-4">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p>Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            <p>Jumlah: {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xl font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-right">
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Checkout</a>
        </div>
    @else
        <p>Keranjang Anda kosong.</p>
    @endif
</div>
@endsection
