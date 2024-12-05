@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/uploadproduk.css') }}">

<div class="UploadProduk">
    <div class="form-container">
        <h2 class="collection-title">Tambah Produk</h2>

        <!-- <div class="form-group">
            <label for="idproduk">ID Produk</label>
            <input type="text" id="idproduk" name="idproduk" value="PROD-12345" readonly>
        </div> -->

        <!-- Product Detail Section -->
        <div class="detail-section">
            <h3>Detail</h3>

            <!-- Form Baru -->
            <form action="{{ route('kirimProduk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Upload Photo Section -->
                <div class="upload-photo">
                    <label for="tambahfoto">Tambah Foto</label>
                    <div class="image-grid" id="imageGrid">
                        <!-- "Tambah foto" button slot -->
                    <div class="image-slot add-photo" onclick="document.getElementById('fileInput').click()">
                        <span>Foto</span>
                        <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display: none;" onchange="previewImages()">
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="pakaian">Pakaian</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="pecah belah">Pecah Belah</option>
                        <option value="perabotan">Perabotan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Produk</label>
                    <input type="text" id="jenis" name="jenis" placeholder="Jenis">
                </div>
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="5" placeholder="Deskripsi Produk" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Harga Produk</label>
                    <input type="number" id="price" name="price" placeholder="0" min="0" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" placeholder="0" min="1" required>
                </div>
                <div class="form-group">
                    <label for="condition">Kondisi</label>
                    <select name="condition" id="condition" required>
                        <option value="new">Barang Baru</option>
                        <option value="used">Barang Bekas</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" required>
                        <option value="pakaian">Pakaian</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="pecah belah">Pecah Belah</option>
                    </select>
                </div> -->
                <!-- <div class="form-group">
                    <label for="images">Upload Gambar</label>
                    <input type="file" id="images" name="images[]" multiple>
                </div> -->
                <button type="submit" class="submit-btn">Tambah Produk</button>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImages() {
        const fileInput = document.getElementById('fileInput');
        const imageGrid = document.getElementById('imageGrid');

        Array.from(fileInput.files).forEach(file => {
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imageSlot = document.createElement('div');
                    imageSlot.classList.add('image-slot');

                    imageSlot.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button class="delete-button" onclick="removeImage(this)">×</button>
                    `;

                    imageGrid.insertBefore(imageSlot, imageGrid.querySelector('.add-photo'));
                };

                reader.readAsDataURL(file);
            }
        });
    }

    function removeImage(button) {
        const imageSlot = button.parentElement;
        imageSlot.remove();
    }

    function showPopup(message) {
        alert(message);
    }
</script>
@endsection
