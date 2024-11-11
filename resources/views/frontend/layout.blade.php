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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('second_choice/css/login-popup.css') }}" />
    <style>
      .brand-section .logo img {
  width: 250px;       /* Atur ukuran lebar logo */
  height: auto;       /* Menjaga proporsi tinggi logo */
  transition: transform 0.3s ease;  /* Menambahkan animasi transisi */
}

.brand-section .logo img:hover {
  transform: scale(1.1);  /* Logo akan membesar 10% saat di-hover */
}

    </style>

    <title>
      SecondChoice &mdash;  Twice the Style, Half the Price
    </title>

    <!-- Di bagian head -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Di bagian head, tambahkan CSS slider -->
    <link rel="stylesheet" href="{{ asset('second_choice/css/slider.css') }}">
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
              <img src="{{ asset('images/logo scnd.png') }}" alt="Logo">
              </a>
            </div>
            

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
                @guest
                    <a href="#" class="btn login-trigger">Login</a>
                    <a href="#" class="btn register-trigger">Sign up</a>
                @else
                    <div class="nav-icons">
                      <a href="{{ route('home') }}" class="btn btn-home">Home</a>
                        <a href="{{ route('messages') }}" class="icon-link">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                        <a href="{{ route('cart') }}" class="icon-link">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                        <div class="user-dropdown">
                            <a href="#" class="icon-link" id="userDropdownToggle">
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <div class="dropdown-menu" id="userDropdownMenu">
                              <a href="{{ route('profile.index') }}" class="dropdown-item">
                                  <i class="fa-regular fa-user"></i> Profile
                              </a>
                                <a href="{{ route('purchases') }}" class="dropdown-item">
                                    <i class="fa-solid fa-bag-shopping"></i> Purchases
                                </a>
                                <a href="{{ route('settings') }}" class="dropdown-item">
                                    <i class="fa-solid fa-gear"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
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

    <!-- Tambahkan setelah nav dan sebelum content -->
    <div class="login-popup-overlay"></div>
    <div class="login-popup">
        <button class="close-button">&times;</button>
        <h2>Login</h2>
        
        <button onclick="window.location.href='/auth/redirect'" class="google-login-btn">
          <img src="{{ asset('second_choice/images/google-icon.svg') }}" alt="Google" width="20">
          Continue with Google
      </button>
      
        
        <div class="divider">atau</div>
        
        <form class="login-form" id="loginForm">
            @csrf
            <input type="text" name="email" placeholder="Username atau email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="error-message" style="color: red; margin-bottom: 10px; display: none;"></div>
            
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="signup-link">
            Belum punya akun? <a href="#" class="signup-trigger">Signup</a>
        </div>
    </div>

    <!-- Tambahkan setelah login popup -->
    <div class="register-popup">
        <button class="close-button">&times;</button>
        <h2>Create account</h2>
        
        <button onclick="window.location.href='/auth/redirect'" class="google-login-btn">
          <img src="{{ asset('second_choice/images/google-icon.svg') }}" alt="Google" width="20">
          Continue with Google
      </button>
        
        <div class="divider">atau</div>
        
        <form class="register-form" id="registerForm">
            @csrf
            <input type="text" name="name" placeholder="Nama lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="error-message"></div>
            
            <button type="submit" class="signup-btn">Sign up</button>
        </form>
        
        <div class="login-link">
            Sudah punya akun? <a href="#" class="login-trigger">Login</a>
        </div>
        
        <div class="terms-text">
            By joining, you agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.
        </div>
    </div>

    <!-- Langsung mulai konten setelah navbar -->
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
    <script src="{{ asset('second_choice/js/login-popup.js') }}"></script>

    <!-- Di bagian bawah sebelum closing body, tambahkan JS slider -->
    <script src="{{ asset('second_choice/js/slider.js') }}"></script>
  </body>
</html>