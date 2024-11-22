@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/styleedit.css') }}" />
<div class="container mt-5">
    <h2>Pengaturan Profil</h2>

    <!-- Bagian Profile Section -->
    <section class="profile-section">
    <div class="profile">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <h2>{{ Auth::user()->name }}</h2>
            <!-- <p>@{{ Auth::user()->username }}</p> -->
            </div>

        <!-- Form Edit Profile -->
        <div class="profile-form">
            <div class="profile-picture">
                <img src="{{ asset('public/images/dino.png') }}" alt="Foto Profil" class="profile-photo">
                <button class="btn btn-secondary">Ganti Gambar</button>
                <button class="btn btn-danger">Hapus</button>
            </div>

            <form action="{{ route('updateProfile') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3" placeholder="Perkenalkan dirimu atau jelasin produk yang kamu jual.">{{ Auth::user()->bio }}</textarea>
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" class="form-control" value="{{ Auth::user()->website }}" placeholder="Link ke Instagram atau website pribadimu">
                </div>

                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>
        </div>
    </section>


    <!-- Bagian Jika Belum Ada Item -->
    <div class="no-items">
        <img src="{{ asset('second_choice/images/kuning.png') }}" alt="Eyes Icon">
        <p>Belum ada item</p>
    </div>
</div>
@endsection
