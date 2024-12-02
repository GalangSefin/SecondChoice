@extends('frontend.layout')

@section('content')
    <div class="container">
        <h2>Keranjang Belanja</h2>
        @if($cartItems->isEmpty())
            <p>Keranjang Anda kosong.</p>
        @else
            <ul>
                @foreach($cartItems as $cartItem)
                    <li>
                        <img src="{{ asset('storage/' . $cartItem->product->images->first()->decoded_image) }}" alt="{{ $cartItem->product->name }}" width="50">
                        <strong>{{ $cartItem->product->name }}</strong>
                        <p>Harga: Rp {{ number_format($cartItem->price, 0, ',', '.') }}</p>
                        <p>Jumlah: {{ $cartItem->quantity }}</p>
                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
