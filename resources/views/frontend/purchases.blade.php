@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/purchases.css') }}" />
<div class="container mt-5">
    <h1 class="title">Purchases</h1>

    <!-- Loop untuk menampilkan daftar pesanan -->
@foreach($purchases as $purchase)
<div class="card">
    <div class="image-container">
        <img src="{{ asset('second_choice/images/' . $purchase->image) }}" alt="{{ $purchase->name }}">
    </div>
    <div class="details">
        <h2>{{ $purchase->name }}</h2>
        <p>{{ $purchase->size }}, {{ $purchase->color }}</p>
        <p>Rp{{ number_format($purchase->price, 0, ',', '.') }}</p>
        <p>Total: Rp{{ number_format($purchase->total, 0, ',', '.') }}</p>
        <p>Estimated Diterima: {{ $purchase->estimated_delivery }}</p>

        <!-- Badge Status Pesanan -->
        @if($purchase->status == 'dikemas')
            <span class="badge bg-warning">Dikemas</span>
        @elseif($purchase->status == 'dikirim')
            <span class="badge bg-info">Dikirim</span>
        @elseif($purchase->status == 'diterima')
            <span class="badge bg-success">Pesanan Diterima</span>
        @else
            <span class="badge bg-danger">Status Tidak Diketahui</span>
        @endif
    </div>
</div>
@endforeach

</div>

@endsection
