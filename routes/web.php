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

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

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

// Protected Routes (Requires Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/purchases', 'PurchaseController@index')->name('purchases');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes untuk halaman profil pengguna
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Routes untuk halaman pengaturan (Settings)
    Route::get('/settings', [SettingController::class, 'editProfile'])->name('settings');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('updateProfile');

    // Routes for DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user-stats', [DashboardController::class, 'showUserStats'])->name('dashboard.user-stats');

    Route::get('/pesanan', [pesananController::class, 'index'])->name('pesanan');
});

// Admin Routes
Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
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

// Social Login routes
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);


//jual
Route::get('/jual', [JualController::class, 'index'])->name('jual');

// Route untuk menampilkan form produk
Route::get('/produk/upload', [UpProdukController::class, 'tampilForm'])->name('produk.upload');

// Route untuk mengirimkan produk (POST request)
Route::post('/produk', [UpProdukController::class, 'kirimProduk'])->name('kirimProduk');

// Routes untuk CRUD produk
Route::get('/produk', [UpProdukController::class, 'index'])->name('produk.index'); // Tampilkan semua produk
Route::get('/produk/create', [UpProdukController::class, 'create'])->name('produk.create'); // Tampilkan form tambah produk
Route::post('/produk', [UpProdukController::class, 'store'])->name('produk.store'); // Simpan produk baru
Route::get('/produk/{id}/edit', [UpProdukController::class, 'edit'])->name('produk.edit'); // Tampilkan form edit produk
Route::put('/produk/{id}', [UpProdukController::class, 'update'])->name('produk.update'); // Update produk
Route::delete('/produk/{id}', [UpProdukController::class, 'destroy'])->name('produk.destroy'); // Hapus produk