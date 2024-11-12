@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/dashboard.css') }}" />

<div class="container mt-5">
    <div class="dashboard">
        <aside class="sidebar">
            <div class="profile">
                <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <h2>{{ Auth::user()->name }}</h2>
                <p>@{{ Auth::user()->username }}</p>
            </div>
            <a href="{{ route('produk.upload') }}"><button>+ Upload produk</button></a>
            <nav>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Overview</a></li>
                    <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <header>
                <h1>Pesanan</h1>
                <p>Tidak ada pesanan</p>
            </header>
        </main>
    </div>
</div>
@endsection
