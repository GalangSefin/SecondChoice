@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/styleeditalamat.css') }}">
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Ubah alamat</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('address.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Penerima -->
                <div class="form-group">
                    <label for="recipient_name">Nama penerima</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" placeholder="Eki Nanda" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="form-group">
                    <label for="phone_number">Nomor telepon</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="cth: 08123456789" required>
                </div>

                <!-- Pencarian Alamat -->
                <div class="form-group">
                    <label for="search_address">Cari alamatmu</label>
                    <input type="text" class="form-control" id="search_address" name="search_address" placeholder="cth: nama jalan/gedung/perumahan">
                </div>

                <!-- Map -->
                <div class="form-group">
                    <label for="map">Peta Lokasi</label>
                    <div id="map" style="width: 100%; height: 400px;"></div> <!-- Map Container -->
                </div>

                <!-- Alamat Lengkap -->
                <div class="form-group">
                    <label for="full_address">Alamat lengkap</label>
                    <textarea class="form-control" id="full_address" name="full_address" placeholder="cth: ada nama perumahan, apartemen, kost" rows="3" required>{{ Auth::user()->alamat }}</textarea>
                </div>

                <!-- Detail Lainnya -->
                <div class="form-group">
                    <label for="additional_detail">Detail lainnya (opsional)</label>
                    <input type="text" class="form-control" id="additional_detail" name="additional_detail" placeholder="cth: blok, unit no. atau patokan">
                </div>

                <!-- Tombol Simpan -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Simpan alamat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap"
    async
    defer></script>
<script>
    let map;
    let marker;

    function initMap() {
        // Lokasi default (Indonesia)
        const defaultLocation = { lat: -6.200000, lng: 106.816666 }; // Jakarta

        // Inisialisasi Map
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 10,
        });

        // Tambahkan marker default
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true, // Marker bisa digeser
        });

        // Update alamat berdasarkan lokasi marker
        marker.addListener('dragend', function () {
            const position = marker.getPosition();
            updateAddress(position.lat(), position.lng());
        });
    }

    function updateAddress(lat, lng) {
        // Gunakan Geocoding API Google Maps untuk mendapatkan alamat
        const geocoder = new google.maps.Geocoder();
        const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

        geocoder.geocode({ location: latlng }, function (results, status) {
            if (status === "OK") {
                if (results[0]) {
                    // Isi textarea dengan alamat yang diperoleh
                    document.getElementById("full_address").value = results[0].formatted_address;
                } else {
                    alert("Alamat tidak ditemukan!");
                }
            } else {
                alert("Geocoder gagal: " + status);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const inputAlamat = document.getElementById('alamat');
        const textareaFullAddress = document.getElementById('full_address');

        // Sinkronisasi otomatis saat input diubah
        inputAlamat.addEventListener('input', function () {
            textareaFullAddress.value = inputAlamat.value;
        });
    });
</script>
@endsection
 