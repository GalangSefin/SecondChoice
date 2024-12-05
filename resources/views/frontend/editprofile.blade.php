@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/styleedit.css') }}" />

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    <div class="profile-container">
        <h2 class="profile-title">Pengaturan Profil</h2>

        <div class="profile-content">
            <!-- Profile Image Section -->
            <div class="profile-image-section">
                @if($user->profile_picture)
                    @php
                        $base64Content = Storage::get('public/profile_pictures/' . $user->profile_picture);
                    @endphp
                    <img src="data:image/jpeg;base64,{{ $base64Content }}" 
                         alt="Profile Picture"
                         class="profile-image" id="previewImage">
                @else
                    <div class="avatar-placeholder" id="avatarPlaceholder">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <h3 class="profile-name">{{ $user->name }}</h3>
                
                <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    <div class="button-group">
                        <button type="button" class="btn btn-secondary" id="changePhotoBtn">
                            <i class="fas fa-camera"></i> Ganti
                        </button>
                        <input type="file" id="profile_picture" name="profile_picture" 
                               class="hidden" accept="image/*" style="display: none;">
                        
                        @if($user->profile_picture)
                            <button type="button" class="btn btn-danger" id="deletePhotoBtn">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Form Section -->
            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="tel" name="phone_number" value="{{ $user->phone_number }}" 
                               class="form-control" placeholder="Masukkan nomor HP">
                    </div>
                </div>

                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3" 
                              placeholder="Perkenalkan dirimu atau jelasin produk yang kamu jual.">{{ $user->bio }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" name="website" value="{{ $user->website }}" 
                               class="form-control" placeholder="Link Instagram/website">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="{{ $user->alamat }}" 
                               class="form-control" placeholder="Alamat lengkap">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi elemen-elemen
    const fileInput = document.getElementById('profile_picture');
    const changeBtn = document.getElementById('changePhotoBtn');
    const deleteBtn = document.getElementById('deletePhotoBtn');
    const profileForm = document.getElementById('profileForm');

    // Event listener untuk tombol Ganti
    if (changeBtn) {
        changeBtn.addEventListener('click', function() {
            fileInput.click();
        });
    }

    // Event listener untuk file input
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    // Hapus placeholder jika ada
                    const placeholder = document.getElementById('avatarPlaceholder');
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                    
                    // Tampilkan preview
                    let previewImage = document.getElementById('previewImage');
                    if (!previewImage) {
                        previewImage = document.createElement('img');
                        previewImage.id = 'previewImage';
                        previewImage.className = 'profile-image';
                        document.querySelector('.profile-image-section').insertBefore(
                            previewImage, 
                            document.querySelector('.profile-name')
                        );
                    }
                    previewImage.src = e.target.result;
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Event listener untuk tombol Hapus
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                fetch('{{ route("deleteProfilePicture") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus gambar dan tampilkan placeholder
                        const previewImage = document.getElementById('previewImage');
                        if (previewImage) {
                            previewImage.remove();
                        }
                        
                        const placeholder = document.getElementById('avatarPlaceholder');
                        if (placeholder) {
                            placeholder.style.display = 'block';
                        }
                        
                        // Hapus tombol delete
                        if (deleteBtn) {
                            deleteBtn.remove();
                        }

                        // Reload halaman untuk memastikan semua terupdate
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus foto profil: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus foto');
                });
            }
        });
    }

    // Event listener untuk form submit
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            // Form akan di-submit normal
        });
    }
});
</script>
@endpush
