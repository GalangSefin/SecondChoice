@extends('frontend.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Keranjang Belanja</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($keranjangItems->isNotEmpty())
        @foreach ($keranjangItems as $sellerId => $items)
            <div class="bg-white rounded-lg shadow-md mb-6 p-4">
                <!-- Informasi Toko -->
                <div class="border-b pb-2 mb-4">
                    <h2 class="text-lg font-semibold">
                        {{ $items->first()->seller->name }}
                    </h2>
                </div>

                <!-- Items dari toko -->
                @foreach ($items as $item)
                    <div class="flex items-center justify-between py-4 border-b">
                        <div class="flex items-center space-x-4">
                            <!-- Gambar Produk -->
                            <img 
                                src="{{ $item->product->images->first()->decoded_image ?? asset('second_choice/images/no-image.png') }}"
                                alt="{{ $item->product->name }}"
                                class="w-20 h-20 object-cover rounded"
                            >
                            
                            <!-- Informasi Produk -->
                            <div>
                                <h3 class="font-semibold">{{ $item->product->name }}</h3>
                                <p class="text-gray-600">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Stok: {{ $item->product->stock }}
                                </p>
                                
                                <!-- Quantity Control -->
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="number" 
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        max="{{ $item->product->stock }}"
                                        class="w-20 px-2 py-1 border rounded"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Subtotal dan Aksi -->
                        <div class="text-right">
                            <p class="font-semibold">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </p>
                            <button 
                                class="text-red-500 hover:text-red-700 mt-2"
                                onclick="removeItem('{{ $item->id }}')"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <!-- Tombol Checkout -->
        <div class="text-right mt-4">
            <a href="" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Checkout
            </a>
        </div>
    @else
        <p class="text-center py-8">Keranjang Anda kosong.</p>
    @endif
</div>

<script>
function removeItem(id) {
    if(confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        fetch(`/keranjang/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        }).then(() => {
            window.location.reload();
        });
    }
}
</script>
@endsection
