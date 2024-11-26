<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;



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
Route::get('/home', function () {
    return view('frontend.home'); // Mengarahkan ke layout.blade.php
})->name('home');

// Protected Routes (Requires Auth, Verified Email & Active User)
Route::middleware(['auth', 'verified', 'user.active'])->group(function () {
    // Semua route yang membutuhkan user aktif
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/purchases', 'PurchaseController@index')->name('purchases');
    
    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Settings routes
    Route::get('/settings', [SettingController::class, 'editProfile'])->name('settings');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('updateProfile');

    // Dashboard routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user-stats', [DashboardController::class, 'showUserStats'])->name('dashboard.user-stats');
    });

    // Pesanan & Purchase routes
    Route::get('/pesanan', [pesananController::class, 'index'])->name('pesanan');
    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::post('/{id}/confirm', [PurchaseController::class, 'confirmReceived'])->name('purchases.confirm');
    });

    // Product routes
    Route::prefix('produk')->group(function () {
        Route::get('/upload', [UpProdukController::class, 'tampilForm'])->name('produk.upload');
        Route::post('/', [UpProdukController::class, 'kirimProduk'])->name('kirimProduk');
    });
    Route::get('/products', [ProductController::class, 'viewAll'])->name('products.viewall');
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

// Route untuk halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Proses data pengiriman
Route::post('/checkout/shipping', [CheckoutController::class, 'handleShipping'])->name('checkout.shipping');

// Halaman pembayaran
Route::get('/checkout/payment', [CheckoutController::class, 'paymentPage'])->name('payment.index');

// Route untuk halaman keranjang belanja (cart)
Route::get('/cart', [CheckoutController::class, 'cartPage'])->name('cart');

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
