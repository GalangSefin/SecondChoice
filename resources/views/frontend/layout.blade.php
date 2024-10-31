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
    

    <title>
      SecondChoice &mdash;  Twice the Style, Half the Price
    </title>
  </head>
  <body>
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

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
