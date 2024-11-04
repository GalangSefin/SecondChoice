<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="favicon.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('second_choice/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('second_choice/fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('second_choice/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('second_choice/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('second_choice/css/style.css') }}" />

    <link rel="stylesheet" href="{{ asset('second_choice/css/stylesfooter.css') }}" />
    <link rel="stylesheet" href="{{ asset('second_choice/css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('second_choice/css/fonts.css') }}" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <title>
      SecondChoice &mdash;  Twice the Style, Half the Price
    </title>
  </head>
  <body>
    <nav class="site-nav">
      <!-- Bagian atas navbar -->
      <div class="nav-top">
        <div class="container">
          <div class="site-navigation">
            <!-- Logo -->
            <div class="brand-section">
              <a href="{{ route('home') }}" class="logo">
                SECOND CHOICE
              </a>
            </div>

<<<<<<< Updated upstream
    <nav class="site-nav" style="background-color: rgba(255, 255, 255, 0.0); color: #333;">
  <div class="container">
    <div class="menu-bg-wrap" style="background-color: rgba(255, 255, 255, 0.83); color: #333;">
      <div class="site-navigation" style="box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.0); padding-bottom: 1.5px;">
        <a href="index.html" class="logo m-0 float-start">
          <img src="images/logo scnd.png" style="width: 205px; height: auto;">
        </a>

        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
          <li><a href="{{ route('home') }}" style="color: black;">Home</a></li>
          <li><a href="{{ route('messages') }}" style="color: black;">Messages</a></li>
          <li><a href="about.html" style="color: black;">Categories</a></li>
          <li><a href="properties.html" style="color: black;">Login</a></li>
          <li><a href="login.html" style="color: black;">Register</a></li>
        </ul>

        <a
          href="#"
          class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
          data-toggle="collapse"
          data-target="#main-navbar"
          style="color: black;"
        >
          <span></span>
        </a>
      </div>
    </div>
  </div>
</nav>

    <!-- Konten Utama -->
=======
            <!-- Search Bar -->
            <div class="search-section">
              <form action="#" class="d-flex search-form">
                <div class="search-input-wrapper">
                  <svg class="search-icon" width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 19L14.65 14.65M17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z" stroke="#A1A0A7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <input
                    type="text"
                    class="form-control"
                    placeholder=""
                  />
                  <div class="search-placeholder-animation">
                    <span class="placeholder-text">
                      <ul class="placeholder-slide">
                        <li>Stussy</li>
                        <li>Baggy jeans</li>
                        <li>Tas</li>
                        <li>Jersey</li>
                        <li>Nike</li>
                        <li>Stussy</li>
                      </ul>
                    </span>
                  </div>
                </div>
              </form>
            </div>

            <!-- Login/Signup Buttons -->
            <div class="auth-buttons">
              <!-- Mobile Search Button -->
              <button title="Search products" class="search-mobile d-md-none">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                  <path d="M20 20L16.05 16.05M18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11Z" 
                    stroke-width="2" 
                    stroke-linecap="round">
                  </path>
                </svg>
              </button>
              
              <a href="{{ route('login') }}" class="btn d-none d-md-flex">
                Login
              </a>
              <a href="{{ route('register') }}" class="btn">
                Sign up
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bagian bawah navbar -->
      <div class="nav-bottom">
        <div class="container">
          <div class="categories">
            <ul>
              <li><a href="#">Wanita</a></li>
              <li><a href="#">Pria</a></li>
              <li><a href="#">Branded</a></li>
              <li><a href="#">Anak</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- Langsung mulai konten setelah navbar -->
>>>>>>> Stashed changes
    @yield('content')

    <!-- Footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="footer-columns">
          <!-- Column 1: Preloved -->
          <div class="footer-column">
            <h3>Preloved</h3>
            <ul>
              <li><a href="#">About</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </div>

          <!-- Column 2: Discover -->
          <div class="footer-column">
            <h3>Discover</h3>
            <ul>
              <li><a href="#">Cara kerjanya</a></li>
              <li><a href="#">Mulai jualan</a></li>
              <li><a href="#">Thrift shops</a></li>
              <li><a href="#">Nama olshop</a></li>
            </ul>
          </div>

          <!-- Column 3: Help -->
          <div class="footer-column">
            <h3>Help</h3>
            <ul>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </div>

        <!-- Social Media Icons -->
        <div class="social-icons">
          <a href="#"><span class="icon-instagram"></span></a>
          <a href="#"><span class="icon-tiktok"></span></a>
          <a href="#"><span class="icon-facebook"></span></a>
          <a href="#"><span class="icon-x"></span></a>
          <a href="#"><span class="icon-linkedin"></span></a>
        </div>

        <!-- Privacy and Terms -->
        <div class="footer-bottom">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('second_choice/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('second_choice/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('second_choice/js/aos.js') }}"></script>
    <script src="{{ asset('second_choice/js/navbar.js') }}"></script>
    <script src="{{ asset('second_choice/js/counter.js') }}"></script>
    <script src="{{ asset('second_choice/js/custom.js') }}"></script>
  </body>
</html>
