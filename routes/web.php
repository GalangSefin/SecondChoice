<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UpProdukController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\DetailProductController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;


use App\Http\Controllers\NotificationController;
  

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |



// routes/web.php
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// Route::get('/', function () {
//     return view('frontend.home');
// })->name('home');

// login route
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Tampilkan form login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit'); // Proses login

 
Route::get('/messages', function () {
    return view('frontend.messages');
})->name('messages');


Route::post('/ajax-login', [LoginController::class, 'ajaxLogin'])->name('ajax.login')->middleware('web');
Route::post('/ajax-register', [RegisterController::class, 'ajaxRegister'])->name('ajax.register')->middleware('web');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Auth::routes(['login' => false, 'register' => false]); // Disable default auth routes

// Rute untuk logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk halaman home (jika dibutuhkan)


// Protected Routes (Requires Auth, Verified Email & Active User)
Route::middleware(['auth', 'verified', 'user.active'])->group(function () {
    // Semua route yang membutuhkan user aktif
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes untuk halaman profil pengguna
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Routes untuk halaman pengaturan (Settings)
    Route::get('/settings', [SettingController::class, 'editProfile'])->name('settings');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('updateProfile');

    // Dashboard routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user-stats', [DashboardController::class, 'showUserStats'])->name('dashboard.user-stats');
    });

    // Pesanan & Purchase routes
    Route::get('/pesanan', [pesananController::class, 'index'])->name('pesanan');

    // Route notifikasi
    Route::get('/send-notification', [NotificationController::class, 'sendNotification'])
     ->name('send.notification')
     ->middleware('auth');



    // Routes untuk PurchaseController
    Route::post('/purchases/{id}/confirm', [PurchaseController::class, 'confirmReceived'])->name('purchases.confirm');

    // Routes untuk keranjang belanja
    Route::get('/keranjang', [KeranjangController::class, 'showKeranjang'])->name('keranjang.show');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToKeranjang'])->name('keranjang.add');
    Route::post('/keranjang/create', [KeranjangController::class, 'createKeranjang'])->name('keranjang.create');
    Route::delete('/keranjang/remove/{id}', [KeranjangController::class, 'removeFromKeranjang'])->name('keranjang.remove');
    Route::patch('/keranjang/update/{id}', [KeranjangController::class, 'updateQuantity'])->name('keranjang.update');


    // Product routes
    Route::prefix('produk')->group(function () {
        Route::get('/upload', [UpProdukController::class, 'tampilForm'])->name('produk.upload');
        Route::post('/', [UpProdukController::class, 'kirimProduk'])->name('kirimProduk');
    });
    Route::get('/products', [ProductController::class, 'viewAll'])->name('products.viewall');

     // Rute untuk detail produk
     Route::get('/product/{id}', [DetailProductController::class, 'show'])->name('product.show');
     
});

// Admin Routes dengan pengecekan is_active
Route::group([
    'middleware' => ['isAdmin', 'user.active'], 
    'prefix' => 'admin', 
    'as' => 'admin.'
], function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Route untuk simulasi after login
Route::get('/after-login', function () {
    return view('frontend.layouts.after_login');
})->name('after.login');

// Modifikasi route login yang ada
Route::post('/login', function (Request $request) {
    // Handle login logic
    return redirect()->route('after.login');
})->name('login.submit');


Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleCallback']);


//jual
Route::get('/jual', [JualController::class, 'index'])->name('jual');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');
Route::get('/tutorial', function () {
    return view('frontend.tutorialjual');
})->name('tutorial');

//keranjang
Route::get('/keranjang', function () {
    return view('frontend.keranjang');
})->name('keranjang');
// Route untuk halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Proses data pengiriman
Route::post('/checkout/shipping', [CheckoutController::class, 'handleShipping'])->name('checkout.shipping');

// Halaman pembayaran
Route::get('/checkout/payment', [CheckoutController::class, 'paymentPage'])->name('payment.index');

// Google Login Routes
Route::controller(App\Http\Controllers\Auth\GoogleController::class)->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('auth/google/callback', 'handleCallback')->name('google.callback');
});

// Route verifikasi email (tidak perlu user.active)
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        if (auth()->user()->email_verified_at) {
            return redirect()->route('home');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        try {
            $request->fulfill();
            
            // Update is_active setelah verifikasi berhasil
            $user = Auth::user();
            $user->is_active = true;
            // $user->save();

            return redirect()->route('home')
                ->with('success', 'Email berhasil diverifikasi!')
                ->with('showWelcomeModal', true);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Verifikasi email error: ' . $e->getMessage());
            return redirect()->route('home')
                ->with('error', 'Gagal memverifikasi email. Silakan coba lagi.');
        }
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim ulang!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/product-image/{filename}', [UpProdukController::class, 'showImage'])
    ->name('product.image')
    ->middleware('web');

// routes/web.php
Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::delete('/cart/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');



    


    //admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    });
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
    