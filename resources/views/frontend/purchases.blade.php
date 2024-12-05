@extends('frontend.layout')

@section('content')
<style>
  .container1 {
  width: 100%;
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.title {
  text-align: center;
  font-size: 2em;
  color: #870017;
  margin-bottom: 20px;
}

.card {
  display: flex;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
}

.image-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.image-container img {
  width: 100%;
  height: 80px;
  aspect-ratio: 1;
  object-fit: cover;
}

.details {
  flex: 2;
  padding: 20px;
}

.details h2 {
  color: #333;
  font-size: 1.5em;
  margin-bottom: 10px;
}

.details p {
  color: #666;
  margin: 5px 0;
}

.button-received,
.button-shipped {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 1em;
  cursor: pointer;
  transition: background-color 0.3s;
  background-color: #870017;
  color: #fff;
}

.button-received:hover,
.button-shipped:hover {
  background-color: #993333;
}

</style>

<div class="container1">
    <h1 class="title">Purchases</h1>

    <!-- First Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('image/croptop.jpg') }}" alt="Crop Top" />
        </div>
        <div class="details">
            <h2>Crop Top</h2>
            <p>Size M, White</p>
            <p>Rp45.000</p>
            <p>Total: Rp50.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-received">Pesanan Diterima</button>
        </div>
    </div>

    <!-- Second Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('image/galon.jpeg') }}" alt="Galon Aqua" />
        </div>
        <div class="details">
            <h2>Galon Aqua</h2>
            <p>Blue, 19 Liter</p>
            <p>Rp28.000</p>
            <p>Total: Rp33.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-shipped">Dikirim</button>
        </div>
    </div>

    <!-- Third Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('image/kulkas.jpg') }}" alt="Kulkas Bekas" />
        </div>
        <div class="details">
            <h2>Kulkas Bekas</h2>
            <p>Abu-abu, size L</p>
            <p>Rp989.900</p>
            <p>Total: Rp994.900</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-received">Pesanan Diterima</button>
        </div>
    </div>

    <!-- Fourth Item -->
    <div class="card">
        <div class="image-container">
            <img src="{{ asset('image/celana.jpg') }}" alt="Celana" />
        </div>
        <div class="details">
            <h2>Celana Pendek Jeans</h2>
            <p>Biru-Abu, size L</p>
            <p>Rp30.000</p>
            <p>Total: Rp35.000</p>
            <p>Estimated Diterima: 7 Nov - 10 Nov</p>
            <button class="button-shipped">Dikemas</button>
        </div>
    </div>
</div>
@endsection
