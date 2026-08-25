<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'index'])->name('user.home');
Route::get('/beranda', [UserPageController::class, 'index'])->name('user.beranda');
Route::redirect('/pengurus', '/pengurus/ketum');
// Redirect generic /login to the admin login route (app uses admin login names)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/pengurus/ketum', [UserPageController::class, 'ketum'])->name('user.ketum');
Route::get('/pengurus/waketum', [UserPageController::class, 'waketum'])->name('user.waketum');
Route::get('/pengurus/sekben', [UserPageController::class, 'sekben'])->name('user.sekben');
Route::get('/pengurus/litbang', [UserPageController::class, 'litbang'])->name('user.litbang');
Route::get('/pengurus/manajemen-event', [UserPageController::class, 'manajemenEvent'])->name('user.manajemen-event');
Route::get('/pengurus/manajemen-talent', [UserPageController::class, 'manajemenTalent'])->name('user.manajemen-talent');
Route::get('/pengurus/produksi', [UserPageController::class, 'produksi'])->name('user.produksi');
Route::get('/pengurus/rumah-tangga', [UserPageController::class, 'rumahTangga'])->name('user.rumah-tangga');
Route::get('/pengurus/psdm', [UserPageController::class, 'psdm'])->name('user.psdm');
Route::get('/visi-misi', [UserPageController::class, 'visiMisi'])->name('user.visi-misi');
Route::get('/lokasi', [UserPageController::class, 'lokasi'])->name('user.lokasi');
Route::get('/penyewaan', [UserPageController::class, 'penyewaan'])->name('user.penyewaan');
Route::get('/booklet-band', [UserPageController::class, 'bookletBand'])->name('user.booklet-band');
Route::get('/undangan-media-partner', [UserPageController::class, 'undanganMediaPartner'])->name('user.undangan-media-partner');
Route::get('/rilisan', [UserPageController::class, 'rilisan'])->name('user.rilisan');
Route::get('/informasi', [UserPageController::class, 'informasi'])->name('user.informasi');

Route::prefix('admin')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware('admin.auth')->group(function (): void {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/kelola-pengurus', [AdminDashboardController::class, 'kelolaPengurus'])->name('admin.kelola-pengurus');
        Route::post('/kelola-pengurus/{role}', [AdminDashboardController::class, 'updatePengurus'])->name('admin.kelola-pengurus.update');
        Route::get('/kelola-visi-misi', [AdminDashboardController::class, 'kelolaVisiMisi'])->name('admin.kelola-visi-misi');
        Route::post('/kelola-visi-misi', [AdminDashboardController::class, 'updateVisiMisi'])->name('admin.kelola-visi-misi.update');
        Route::get('/kelola-lokasi', [AdminDashboardController::class, 'kelolaLokasi'])->name('admin.kelola-lokasi');
        Route::post('/kelola-lokasi', [AdminDashboardController::class, 'updateLokasi'])->name('admin.kelola-lokasi.update');
        Route::get('/kelola-penyewaan', [AdminDashboardController::class, 'kelolaPenyewaan'])->name('admin.kelola-penyewaan');
        Route::post('/kelola-penyewaan', [AdminDashboardController::class, 'updatePenyewaan'])->name('admin.kelola-penyewaan.update');
        Route::get('/kelola-booklet', [AdminDashboardController::class, 'kelolaBooklet'])->name('admin.kelola-booklet');
        Route::post('/kelola-booklet', [AdminDashboardController::class, 'updateBooklet'])->name('admin.kelola-booklet.update');
        Route::get('/kelola-undangan', [AdminDashboardController::class, 'kelolaUndangan'])->name('admin.kelola-undangan');
        Route::post('/kelola-undangan', [AdminDashboardController::class, 'updateUndangan'])->name('admin.kelola-undangan.update');
        Route::get('/kelola-rilisan', [AdminDashboardController::class, 'kelolaRilisan'])->name('admin.kelola-rilisan');
        Route::post('/kelola-rilisan', [AdminDashboardController::class, 'updateRilisan'])->name('admin.kelola-rilisan.update');
        Route::get('/kelola-informasi', [AdminDashboardController::class, 'kelolaInformasi'])->name('admin.kelola-informasi');
        Route::post('/kelola-informasi', [AdminDashboardController::class, 'updateInformasi'])->name('admin.kelola-informasi.update');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
