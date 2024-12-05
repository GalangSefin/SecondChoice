@extends('frontend.layout')

@section('content')

@if (!isset($keranjangItems) || $keranjangItems->isEmpty())
    <!-- Pesan Keranjang Kosong -->
    <p class="text-center text-gray-500">Keranjang Anda kosong. Silakan tambahkan produk!</p>
@else
    <!-- Iterasi Keranjang -->
    @foreach ($keranjangItems as $sellerId => $items)
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <!-- Informasi Penjual -->
            <div class="flex items-center mb-4">
                <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-4">
                    <span class="text-xl font-bold">
                        {{ isset($items->first()->seller) ? strtoupper($items->first()->seller->name[0]) : '-' }}
                    </span>
                </div>
                <div>
                    <p class="font-semibold">
                        {{ $items->first()->seller->name ?? 'Penjual tidak ditemukan' }}
                    </p>
                </div>
            </div>

            @php $total = 0; @endphp

            <!-- Daftar Produk di Keranjang -->
            @foreach ($items as $item)
                @php
                    $subtotal = $item->quantity * $item->price;
                    $total += $subtotal;
                @endphp
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner flex items-center justify-between mb-3">
                    <!-- Gambar Produk dan Informasi -->
                    <div class="flex items-center">
                        <img 
                            class="w-20 h-20 object-cover mr-4" 
                            src="{{ $item->product->images->first()->decoded_image ?? asset('second_choice/images/no-image.png') }}" 
                            alt="{{ $item->product->name }}" 
                            width="100" 
                            height="100" 
                        />
                        <div>
                            <p class="font-semibold">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600">Ukuran: {{ $item->product->size }}</p>
                            <p class="text-sm text-gray-600">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-sm">Jumlah: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-red-500 text-xl font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        <a href="{{ route('keranjang.remove', $item->id) }}" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-lg">Hapus</a>
                    </div>
                </div>
            @endforeach

            <!-- Total Per Penjual -->
            <div class="mt-4 text-right">
                <p class="font-bold text-lg">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>
    @endforeach
@endif

@endsection