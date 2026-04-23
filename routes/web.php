<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\HomeController;
use App\Models\Court;
use Illuminate\Support\Facades\Route;

// ==========================================
// RUTE PUBLIC (Gak perlu login)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

// Webhook Midtrans harus public biar bisa ditembak server Midtrans
Route::post('/api/midtrans-callback', [BookingController::class, 'midtransCallback']);

// API Jadwal dipindah ke sini biar kalender di halaman depan bisa ngebaca data tanpa login! 🔥
Route::get('/api/courts/{court}/jadwal', [BookingController::class, 'getJadwal'])->name('api.court.jadwal');


// ==========================================
// RUTE USER (Wajib Login)
// ==========================================
Route::get('/dashboard', function () {
    $courts = Court::all();
    return view('dashboard', compact('courts'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking
    Route::get('/riwayat-booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{court_id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{court_id}', [BookingController::class, 'store'])->name('booking.store');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/booking/{id}/upload', [BookingController::class, 'uploadProof'])->name('booking.upload');

    // Review
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});


// ==========================================
// RUTE ADMIN (Wajib Login + Role Admin)
// ==========================================
// PENTING: name('admin.') ditambahin di sini biar semua nama rute di dalamnya otomatis ketambahan 'admin.'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kelola Lapangan (Courts)
    Route::get('/courts', [AdminDashboardController::class, 'courts'])->name('courts.index');
    Route::get('/courts/create', [AdminDashboardController::class, 'createCourt'])->name('courts.create');
    Route::post('/courts', [AdminDashboardController::class, 'storeCourt'])->name('courts.store');
    Route::get('/courts/{id}/edit', [AdminDashboardController::class, 'editCourt'])->name('courts.edit');
    Route::put('/courts/{id}', [AdminDashboardController::class, 'updateCourt'])->name('courts.update');
    Route::delete('/courts/{id}', [AdminDashboardController::class, 'destroyCourt'])->name('courts.destroy');

    // Kelola Booking (Konfirmasi / Batalin)
    Route::patch('/bookings/{id}/confirm', [AdminDashboardController::class, 'confirmPayment'])->name('bookings.confirm');
    Route::delete('/bookings/{id}', [AdminDashboardController::class, 'destroyBooking'])->name('bookings.destroy');

    // Jadwal Global (Kalender)
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/api/global-jadwal', [CalendarController::class, 'getGlobalJadwal'])->name('api.global-jadwal');

    // Kelola Perlengkapan (Equipment)
    Route::resource('equipment', \App\Http\Controllers\Admin\AdminEquipmentController::class);
});

require __DIR__ . '/auth.php';
