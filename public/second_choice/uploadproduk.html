<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Choice - Tambah Produk</title>
    <link rel="stylesheet" href="css/uploadproduk.css">
</head>
<body>
    <div class="UploadProduk">
        <header>
            <h1 class="collection-title">Second Choice</h1>
        </header>
        
        <div class="form-container">
            <h2 class="collection-title">Tambah produk</h2>

            <div class="form-group">
                <label for="idproduk">ID Produk</label>
                <input type="text" id="idproduk" name="idproduk" value="PROD-12345" readonly>
            </div>
            
            <!-- Upload Photo Section -->
            <div class="upload-photo">
                <label for="tambahfoto">Tambah Foto</label>
                <div class="image-grid" id="imageGrid">
                    <!-- "Tambah foto" button slot -->
                    <div class="image-slot add-photo" onclick="document.getElementById('fileInput').click()">
                        <span>Foto</span>
                        <input type="file" id="fileInput" multiple accept="image/*" style="display: none;" onchange="previewImages()">
                    </div>
                </div>
            </div>
            
            <!-- Product Detail Section -->
            <div class="detail-section">
                <h3>Detail</h3>
                <form action="submit_product.php" method="POST">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category" id="category">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <!-- Add your options here -->
                            <option value="pakaian">Pakaian</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="pecah belah">Pecah Belah</option>
                            <option value="perabotan">Perabotan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Jenis</label>
                        <select name="category" id="category">
                            <option value="" disabled selected>Pilih Jenis</option>
                            <!-- Add your options here -->
                            <option value="pakaian">Baju</option>
                            <option value="elektronik">Celana</option>
                            <option value="pecah belah">Jaket</option>
                            <option value="perabotan">Sweater</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Nama Produk</label>
                        <input type="text" id="brand" name="brand" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="brand">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" placeholder="Berikan deskripsi mengenai detail produk"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="brand">Harga Produk</label>
                        <input type="number" id="price" name="price" placeholder="000" min="0" step="0.01" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div class="form-group">
                        <label for="brand">Stok<label>
                            <input type="number" id="price" name="price" placeholder="0" min="0" step="0.01" style="width: 100%; box-sizing: border-box;">
                        </div>
                    <div class="form-group">
                        <label for="condition">Kondisi</label>
                        <select name="condition" id="condition">
                            <option value="" disabled selected>Pilih Kondisi</option>
                            <!-- Add your options here -->
                            <option value="perabotan">Barang Baru</option>
                            <option value="perabotan">Barang Bekas</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="save-draft">Save as draft</button>
                        <button type="submit" class="submit-btn">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImages() {
    const fileInput = document.getElementById('fileInput');
    const imageGrid = document.getElementById('imageGrid');

    // Loop through each selected file
    Array.from(fileInput.files).forEach(file => {
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();
            
            reader.onload = function (e) {
                const imageSlot = document.createElement('div');
                imageSlot.classList.add('image-slot');

                // Add image preview
                imageSlot.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button class="delete-button" onclick="removeImage(this)">×</button>
                `;

                // Append the new image slot before the "Tambah foto" slot
                imageGrid.insertBefore(imageSlot, imageGrid.querySelector('.add-photo'));
            };
            
            reader.readAsDataURL(file);
        }
    });
}

// Function to remove an image slot
function removeImage(button) {
    const imageSlot = button.parentElement;
    imageSlot.remove();
}

    </script>
</body>
</html>
