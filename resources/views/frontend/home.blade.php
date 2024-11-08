@extends('frontend.layout')

@section('content')
    @auth
        {{-- Tampilkan slider ini hanya untuk user yang sudah login --}}
        <div class="dual-slider-container">
            <!-- Left Slider -->
            <div class="slider-section">
                <div class="slider-wrapper" style="background-image: url('images/sell.jpg');">
                    <div class="slide">
                        <div class="slide-content-left">
                            <div class="slide-label-left">Sell</div>
                            <h2>Mulai berjualan</h2>
                            <div class="slide-buttons">
                                <a href="#" class="btn-primary">Jual</a>
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
                            <h2>Explore item terbaru</h2>
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
<div class="section">
  <div class="container">
    <div class="row mb-5 align-items-center">
      <div class="col-lg-6">
        <h2 class="font-weight-bold text-primary heading">
          Popular Properties
        </h2>
      </div>
      <div class="col-lg-6 text-lg-end">
        <p>
          <a
            href="#"
            target="_blank"
            class="btn btn-primary text-white py-3 px-4">View all properties</a>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="property-slider-wrap">
          <div class="property-slider">
            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_7.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_8.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->

            <div class="property-item">
              <a href="property-single.html" class="img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.html"
                    class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>

          <div
            id="property-nav"
            class="controls"
            tabindex="0"
            aria-label="Carousel Navigation">
            <span
              class="prev"
              data-controls="prev"
              aria-controls="property"
              tabindex="-1">Prev</span>
            <span
              class="next"
              data-controls="next"
              aria-controls="property"
              tabindex="-1">Next</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="features-1">
  <div class="container">
    <div style="display: flex; justify-content: flex-start;">
      <div class="box" style="padding: 20px; border: 0px solid #ffffff; background-color: #ffffff;">
        <h3 style="color: black; font-weight: 650;">Belanja sesuai budget</h3>
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

<script src="https://cdn.tailwindcss.com"></script>

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
              class="btn btn-primary text-white py-3 px-4"
              >Apply for Real Estate agent</a
            >
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
                        <img src="images/clothes.jpg"/>
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


  
  



  @endsection
