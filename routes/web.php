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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;


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

    // Routes untuk PurchaseController
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/purchases/{id}/confirm', [PurchaseController::class, 'confirmReceived'])->name('purchases.confirm');

    // Produk Routes
    Route::get('/produk/upload', [UpProdukController::class, 'tampilForm'])->name('produk.upload');
    Route::post('/produk', [UpProdukController::class, 'kirimProduk'])->name('kirimProduk');
    Route::get('/products', [ProductController::class, 'viewAll'])->name('products.viewall');

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

// Modifikasi route login yang ada
Route::post('/login', function (Request $request) {
    // Handle login logic
    return redirect()->route('after.login');
})->name('login.submit');


Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);


//jual
Route::get('/jual', [JualController::class, 'index'])->name('jual');
