<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RegistrasiController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KelompokController;
use App\Http\Controllers\Admin\TimController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\SiteImageController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products (Frontend)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/interior', [ProductController::class, 'interior'])->name('interior');
    Route::get('/build-desain', [ProductController::class, 'buildDesain'])->name('builddesain');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

// Layanan
Route::get('/layanan', function () {
    $siteImages = \App\Models\SiteImage::allKeyed();
    return view('layanan.index', compact('siteImages'));
})->name('layanan.index');

// Registrasi harga
Route::post('/daftar-harga', function(\Illuminate\Http\Request $request) {
    $request->validate([
        'nama'   => 'required|string|max:255',
        'email'  => 'required|email|max:255',
        'telpon' => 'required|string|max:20',
    ]);
    \App\Models\PriceRegistration::firstOrCreate(
        ['email' => $request->email],
        ['nama' => $request->nama, 'telpon' => $request->telpon]
    );
    session(['harga_member' => [
        'nama'   => $request->nama,
        'email'  => $request->email,
        'telpon' => $request->telpon,
    ]]);
    return back()->with('terdaftar', true)
        ->cookie('harga_member_email', $request->email, 60 * 24 * 365);
})->name('harga.daftar');

// Tentang
Route::get('/tentang/hiko', function () {
    $teamMembers = \App\Models\TeamMember::orderBy('urutan')->get();
    return view('about.tentang', compact('teamMembers'));
})->name('about.hiko');
Route::get('/tentang/tim', function () {
    $teamMembers = \App\Models\TeamMember::orderBy('urutan')->get();
    return view('about.tim', compact('teamMembers'));
})->name('about.tim');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim')->middleware('throttle:3,10');

// Admin entry point: shows login for guests, redirects to panel for authenticated
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect('/admin/products');
    }
    return view('auth.login');
})->name('login');

Route::redirect('/login', '/admin');

// Products (Admin)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('products', AdminProductController::class);
    Route::get('registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
    Route::post('registrasi/kirim-email', [RegistrasiController::class, 'kirimEmail'])->name('registrasi.kirimEmail');
    Route::delete('registrasi/{registrasi}', [RegistrasiController::class, 'destroy'])->name('registrasi.destroy');

    Route::middleware(\App\Http\Middleware\EnsureAdmin::class)->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['show', 'create', 'edit']);
        Route::resource('kelompok', KelompokController::class)->except(['show', 'create', 'edit']);
        Route::resource('tim', TimController::class)->except(['show', 'create', 'edit']);
        Route::resource('users', AdminUserController::class)->except(['show', 'create', 'edit']);
        Route::get('site-images', [SiteImageController::class, 'index'])->name('site-images.index');
        Route::post('site-images', [SiteImageController::class, 'store'])->name('site-images.store');
        Route::delete('site-images/{key}', [SiteImageController::class, 'destroy'])->name('site-images.destroy');
        Route::get('logs', [LogController::class, 'index'])->name('logs.index');
        Route::delete('logs', [LogController::class, 'clear'])->name('logs.clear');
    });

    Route::get('enquiry', [EnquiryController::class, 'index'])->name('enquiry.index');
    Route::post('enquiry/mark-all-read', [EnquiryController::class, 'markAllRead'])->name('enquiry.markAllRead');
    Route::get('enquiry/{enquiry}', [EnquiryController::class, 'show'])->name('enquiry.show');
    Route::delete('enquiry/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
});

require __DIR__.'/auth.php';
