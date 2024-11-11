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

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

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
    return view('frontend.layout'); // Mengarahkan ke layout.blade.php
})->name('home');

// Admin Routes
Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Protected Routes (Requires Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.dashboard', ['layout' => 'after_login']);
    })->name('dashboard');

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

//jual
Route::get('/jual', [JualController::class, 'index'])->name('jual');

// Route untuk menampilkan form produk
Route::get('/produk/upload', [UpProdukController::class, 'tampilForm'])->name('produk.upload');

// Route untuk mengirimkan produk (POST request)
Route::post('/produk', [UpProdukController::class, 'kirimProduk'])->name('kirimProduk');
