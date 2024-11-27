@extends('frontend.layout')

@section('content')
    @if(session('showWelcomeModal'))
        <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selamat Datang!</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            Email Anda berhasil diverifikasi!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            $(document).ready(function() {
                $('#welcomeModal').modal('show');
            });
        </script>
        @endpush
    @endif

    @auth
        {{-- Tampilkan slider ini hanya untuk user yang sudah login --}}
        <div class="dual-slider-container">
            <!-- Left Slider -->
            <div class="slider-section">
                <div class="slider-wrapper" style="background-image: url('images/sell.jpg');">
                    <div class="slide">
                        <div class="slide-content-left">
                            <div class="slide-label-left">Sell</div>
                        <div class="slide-content-left">
                            <div class="slide-label-left">Sell</div>
                            <h2>Mulai berjualan</h2>
                            <div class="slide-buttons">
                              <a href="{{ route('jual') }}" class="btn btn-Jual">Jual</a>
                              
                              <a href="{{ route('jual') }}" class="btn btn-Jual">Jual</a>
                              
                                <a href="#" class="btn-secondary">Lihat tutorial</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Slider -->
            <div class="slider-section">
                <div class="slider-wrapper" style="background-image: url('images/explore.jpg');">
                    <div class="slide">
                        <div class="slide-content-right">
                            <div class="slide-label-right">New</div>
                            <h3>Explore item terbaru</h3>
                        <div class="slide-content-right">
                            <div class="slide-label-right">New</div>
                            <h3>Explore item terbaru</h3>
                            <div class="slide-buttons">
                                <a href="#" class="btn-primary">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    @guest
        {{-- Tampilkan hero section ini hanya untuk user yang belum login --}}
        <div class="hero">
            <div class="hero-slide">
                <div class="img overlay" style="background-image: url('images/gambar.jpg');"></div>
                <div class="img overlay" style="background-image: url('images/gambar1.jpg')"></div>
                <div class="img overlay" style="background-image: url('images/gambar2.jpg')"></div>
            </div>

            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-9 text-center">
                        <h1 class="heading" data-aos="fade-up">
                            Twice the Style, Half the Price
                        </h1>
                        <form action="#" class="narrow-w form-search d-flex align-items-stretch mb-3"
                            data-aos="fade-up" data-aos-delay="200">
                            <input type="text" class="form-control px-4"
                                placeholder="Search Quality and Unique Items!" />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    <body class="bg-white">
      <div class="container mx-auto px-4 py-8">
          <div class="flex justify-between items-center mb-6">
              <h1 class="text-3xl font-bold">Produk Terbaru</h1>
              <a href="/collections" class="hidden text-sm font-semibold text-sky-700 hover:text-sky-600 sm:block">
                Lihat Lainya
              </a>
          </div>
          <div class="grid grid-cols-4 gap-6">
              <div class="text-center clickable">
                  <img alt="Black hoodie" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/WqIYEfoFlAQpI6uPfyOEN90Z2ZRhElyiGui9XXLed7jVi3knA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 140.000</p>
                  <p>Champion</p>
                  <p>M</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Brown pants" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/HBf8C9TNaehH7kecDe2SRyfnlmsNAazKcGmE0MS6Y7avIem8E.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 150.000</p>
                  <p>Uniqlo</p>
                  <p>Other</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Black jeans" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/2tRYoh3hsbKKEhqsflYQjVTVCM7h2ztq2Iezse1elRPyEvJPB.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 250.000</p>
                  <p>Agnès B</p>
                  <p>XS</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Black vintage top" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/fqsValKY6hU6YiiI6eOy6Qlz2Tfj4amhjTi2gsQXlhLhi3knA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 65.000</p>
                  <p>Vintage</p>
                  <p>One size</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Black vintage jacket" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/tf3yWeUiMeFZQJXzcfDkzeTF41VBhAq6BvuBsifsJZzUQ8m8E.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 95.000</p>
                  <p>Vintage</p>
                  <p>M</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Leopard print cardigan" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/fpzjbZFZNg0KV6peOByUBonVpsbiJxgk5MYD9lUG1dpGxbyTA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 100.000</p>
                  <p>Uniqlo</p>
                  <p>M</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Colorful vintage shirt" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/ZHswUrwhGD5fK6ZyPbNaGeb20dkkawycyg9IGVCzH1ENxbyTA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 55.000</p>
                  <p>Vintage</p>
                  <p>M</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Green sweater" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/Q1SezFJlmmTELCwTPHnB3Mfx3ZbUJOcGe6e78iCY4o1hEvJPB.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 95.000</p>
                  <p>Uniqlo</p>
                  <p>M</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Black pants" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/lTus5TfOKFWzV60ORNhakY4ue6HGeoZvgZP60mbGqzXeEvJPB.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 300.000</p>
                  <p>Uniqlo</p>
                  <p>One size</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Black vintage shirt" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/HKJxQk9ObX4rDRramed6aCjzY0EPeJ0kHaHdCGajHWHJxbyTA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 200.000</p>
                  <p>Vintage</p>
                  <p>XL</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Levi's jeans and hoodie" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/SJ91OvuzihoCOZTPHgIyyeV7bkbFGC0Wq0a3iheZUObfh3knA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 230.000</p>
                  <p>Levi's</p>
                  <p>Other</p>
              </div>
              <div class="text-center clickable">
                  <img alt="Red and black vintage pants" class="w-full h-auto rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/TAXRm3vIR3JXJF6ddc9WW8zS93yKFcVIf6HzqVSlRVyh4N5JA.jpg" width="300"/>
                  <p class="mt-2 font-bold">Rp 375.000</p>
                  <p>Vintage</p>
                  <p>S</p>
              </div>
          </div>
      </div>
  </body>
  
    <section class="px-4 pt-24 space-y-10 sm:px-6 sm:pt-20 xl:mx-auto xl:max-w-7xl lg:px-8">
      <!-- Header Section -->
      <div class="sm:flex sm:items-center sm:justify-between">
        <h2 class="text-3xl font-bold">Kategori Populer</h2>
        <a href="/collections" class="hidden text-sm font-semibold text-sky-700 hover:text-sky-600 sm:block">
          Lihat Lainnya
        </a>
      </div>

      <!-- Collections Grid -->
      <div class="mt-6 flow-root">
        <div class="-my-2">
          <div class="relative box-content h-64 overflow-x-auto py-2 xl:overflow-visible">
            <div class="min-w-screen-xl flex space-x-8 px-4 sm:px-6 lg:px-8 xl:grid xl:grid-cols-5 xl:gap-8 xl:space-x-0 xl:px-8">
              <!-- Collection Item: Smartphones -->
              <a href="/collections/smartphones" class="group relative flex h-64 w-56 flex-col overflow-hidden rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 xl:w-auto">
                <span aria-hidden="true" class="absolute inset-0">
                  <img 
                    src="images/bajuhanger.jpg" 
                    alt="Pakaian" 
                    class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-110"
                  >
                </span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-50"></span>
                <span class="relative mt-auto text-center text-xl font-bold text-white">
                  Pakaian
                </span>
              </a>
    
              <!-- Collection Item: Clothes -->
              <a href="/collections/clothes" class="group relative flex h-64 w-56 flex-col overflow-hidden rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 xl:w-auto">
                <span aria-hidden="true" class="absolute inset-0">
                  <img 
                    src="images/tools-table.png" 
                    alt="Perabotan" 
                    class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-110"
                  >
                </span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-50"></span>
                <span class="relative mt-auto text-center text-xl font-bold text-white">
                  Peralatan
                </span>
              </a>
    
              <!-- Collection Item: Accessories -->
              <a href="/collections/accessories" class="group relative flex h-64 w-56 flex-col overflow-hidden rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 xl:w-auto">
                <span aria-hidden="true" class="absolute inset-0">
                  <img 
                    src="images/perabotan.jpg" 
                    alt="Accessories" 
                    class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-110"
                  >
                </span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-50"></span>
                <span class="relative mt-auto text-center text-xl font-bold text-white">
                  Perabotan
                </span>
              </a>
    
              <!-- Collection Item: Shoes -->
              <a href="/collections/shoes" class="group relative flex h-64 w-56 flex-col overflow-hidden rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 xl:w-auto">
                <span aria-hidden="true" class="absolute inset-0">
                  <img 
                    src="images/elektro.jpg" 
                    alt="Shoes" 
                    class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-110"
                  >
                </span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-50"></span>
                <span class="relative mt-auto text-center text-xl font-bold text-white">
                  Perlengkapan Elektronik
                </span>
              </a>
    
              <!-- Collection Item: Bags -->
              <a href="/collections/bags" class="group relative flex h-64 w-56 flex-col overflow-hidden rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 xl:w-auto">
                <span aria-hidden="true" class="absolute inset-0">
                  <img 
                    src="images/pecah.png" 
                    alt="Bags" 
                    class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-110"
                  >
                </span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-50"></span>
                <span class="relative mt-auto text-center text-xl font-bold text-white">
                  Pecah Belah
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    

    <section class="features-1 pt-20 pb-16 px-8">
  <div class="container">
    <div style="display: flex; justify-content: flex-start;">
      <div class="box" style="padding: 20px; border: 0px solid;">
        <h1 class="text-3xl font-bold">Produk Terbaru</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="box-feature" style="cursor: pointer;">
          <!-- <span class="flaticon-house"></span> -->
          <h3 class="mb-3">Harga dibawah</h3>
          <h4 class="mb-3">100 Ribu</h4>
          <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Voluptates, accusamus.
              </p> -->
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="box-feature" style="cursor: pointer;">
          <!-- <span class="flaticon-building"></span> -->
          <h3 class="mb-3">Harga dibawah</h3>
          <h4 class="mb-3">250 Ribu</h4>
          <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Voluptates, accusamus.
              </p> -->
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="box-feature" style="cursor: pointer;">
          <!-- <span class="flaticon-house-3"></span> -->
          <h3 class="mb-3">Harga dibawah</h3>
          <h4 class="mb-3">350 Ribu</h4>
          <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Voluptates, accusamus.
              </p> -->
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="box-feature" style="cursor: pointer;">
          <!-- <span class="flaticon-house-1"></span> -->
          <h3 class="mb-3">Harga dibawah</h3>
          <h4 class="mb-3">500 Ribu</h4>
          <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Voluptates, accusamus.
              </p> -->
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <ulasan pelanggan > --}}

<body class="bg-gray-100 text-gray-800">
  <div class="section sec-testimonials py-10">
    <div class="container mx-auto px-4">
      <div class="row mb-5 flex flex-wrap items-center justify-between">
        <div class="w-full md:w-auto">
          <h2 class="font-bold text-3xl text-primary mb-4 md:mb-0 text-blue-600">
            Ulasan Pelanggan
          </h2>
        </div>
        <div class="w-full md:w-auto text-md-end">
          <div id="testimonial-nav" class="flex space-x-4 text-blue-600">
            <span class="prev cursor-pointer hover:text-blue-800 transition" data-controls="prev">Prev</span>
            <span class="next cursor-pointer hover:text-blue-800 transition" data-controls="next">Next</span>
          </div>
        </div>
      </div>

      <!-- Bagian Produk -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Produk 1 -->
        <div class="bg-white text-black rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
          <img src="images/adat.png" alt="Baju Adat" class="w-full h-40 object-cover">
          <div class="p-4">
            <p class="text-sm text-gray-600">Sold by <span class="font-bold">Saipulllll</span></p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-400 text-lg">★★★★★</span>
            </div>
          </div>
        </div>

        <!-- Produk 2 -->
        <div class="bg-white text-black rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
          <img src="images/madura.png" alt="Madura" class="w-full h-40 object-cover">
          <div class="p-4">
            <p class="text-sm text-gray-600">Sold by <span class="font-bold">Kiplii</span></p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-400 text-lg">★★★★☆</span>
            </div>
          </div>
        </div>

        <!-- Produk 3 -->
        <div class="bg-white text-black rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
          <img src="images/kabau.png" alt="kabau" class="w-full h-40 object-cover">
          <div class="p-4">
            <p class="text-sm text-gray-600">Sold by <span class="font-bold">Ari dan Ana</span></p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-400 text-lg">★★★★★</span>
            </div>
          </div>
        </div>

        <!-- Produk 4 -->
        <div class="bg-white text-black rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
          <img src="images/bali.png" alt="Bali" class="w-full h-40 object-cover">
          <div class="p-4">
            <p class="text-sm text-gray-600">Sold by <span class="font-bold">Bruno</span></p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-400 text-lg">★★★★☆</span>
            </div>
          </div>
        </div>

        <!-- Produk 5 -->
        <div class="bg-white text-black rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
          <img src="images/toraja.png" alt="Toraja" class="w-full h-40 object-cover">
          <div class="p-4">
            <p class="text-sm text-gray-600">Sold by <span class="font-bold">Lisa Blackpink</span></p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-400 text-lg">★★★★★</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="row justify-content-center footer-cta" data-aos="fade-up">
      <div class="col-lg-7 mx-auto text-center">
        <h2 class="mb-4">Be a part of our growing real state agents</h2>
        <p>
          <a
            href="#"
            target="_blank"
            class="btn btn-primary text-white py-3 px-4">Apply for Real Estate agent</a>
        </p>
      </div>
      <!-- /.col-lg-7 -->
    </div>
    <!-- /.row -->
  </div>

  <div class="section section-5 bg-light">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-lg-6 mb-5">
          <h2 class="font-weight-bold heading text-primary mb-4">
            Kategori
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <a href="workwear.html">
            <div class="image-box">
              <img src="images/eki.png" />
            </div>
            <p class="collection-title">Pecah Beling</p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a href="reworked.html">
            <div class="image-box">
              <img src="images/clothes.jpg" />
            </div>
            <p class="collection-title">Pakaian</p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a href="y2k.html">
            <div class="image-box">
              <img src="images/perabotan.jpg" alt="Y2K 2000s Core" class="img-fluid" />
            </div>
            <p class="collection-title">Perabotan</p>
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- Dual Slider Section -->

  @endsection
