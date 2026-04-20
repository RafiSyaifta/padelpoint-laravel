<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Models\Court;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Ambil semua data lapangan dari database
    $courts = Court::all();

    // Kirim data $courts ke halaman dashboard
    return view('dashboard', compact('courts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/booking/{court_id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{court_id}', [BookingController::class, 'store'])->name('booking.store');
    // Rute buat nampilin Riwayat Booking
    Route::get('/riwayat-booking', [BookingController::class, 'index'])->name('booking.index');
    // Rute BARU buat ngehapus (Batalin) Booking
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Pastiin penulisan class-nya begini:
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/courts', [AdminDashboardController::class, 'courts'])->name('admin.courts.index');
    Route::get('/courts/create', [AdminDashboardController::class, 'createCourt'])->name('admin.courts.create');
    Route::post('/courts', [AdminDashboardController::class, 'storeCourt'])->name('admin.courts.store');
    Route::get('/courts/{id}/edit', [AdminDashboardController::class, 'editCourt'])->name('admin.courts.edit');
    Route::put('/courts/{id}', [AdminDashboardController::class, 'updateCourt'])->name('admin.courts.update');
    Route::delete('/courts/{id}', [AdminDashboardController::class, 'destroyCourt'])->name('admin.courts.destroy');
    Route::delete('/admin/bookings/{id}', [AdminDashboardController::class, 'destroyBooking'])->name('admin.bookings.destroy');
});

require __DIR__.'/auth.php';
