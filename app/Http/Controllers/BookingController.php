<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create($court_id)
    {
        $court = Court::findOrFail($court_id); // Panggil nama pendeknya aja
        return view('booking.create', compact('court'));
    }

    public function index()
    {
        // Ambil booking hanya milik user yang login
        $bookings = Booking::where('user_id', auth()->id())
                    ->with('court') // Biar nama lapangannya muncul
                    ->latest()
                    ->get();

        return view('booking.index', compact('bookings'));
    }

    // Di dalam method store(Request $request)
    public function store(Request $request)
    {
        // 1. Validasi input dasar
        $request->validate([
            'court_id' => 'required',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // 2. CEK JADWAL BENTROK
        $isBentrok = Booking::where('court_id', $request->court_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Skenario 1: Jam mulai baru ada di antara jam booking orang lain
                    $q->where('start_time', '<=', $request->start_time)
                    ->where('end_time', '>', $request->start_time);
                })->orWhere(function ($q) use ($request) {
                    // Skenario 2: Jam selesai baru ada di antara jam booking orang lain
                    $q->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>=', $request->end_time);
                })->orWhere(function ($q) use ($request) {
                    // Skenario 3: Jam baru justru membungkus jam booking orang lain
                    $q->where('start_time', '>=', $request->start_time)
                    ->where('end_time', '<=', $request->end_time);
                });
            })
            ->exists();

        if ($isBentrok) {
            return back()->withErrors(['error' => 'Maaf, lapangan sudah dipesan di jam tersebut!'])->withInput();
        }

    // 3. Jika aman, simpan ke database
    Booking::create([
        'user_id' => auth()->id(),
        'court_id' => $request->court_id,
        'booking_date' => $request->booking_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'status' => 'pending',
    ]);

    return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat!');
}

    // Fungsi buat ngebatalin/ngehapus booking
    public function destroy($id)
    {
        // 1. Cari tiket bookingnya berdasarkan ID
        $booking = Booking::findOrFail($id);

        // 2. CEK KEAMANAN: Pastikan tiket ini beneran punya user yang lagi login!
        if ($booking->user_id !== auth()->id()) {
            // Kalau bukan punya dia, tendang balik! (Jangan biarin hacker iseng)
            abort(403, 'Akses Ditolak: Anda tidak berhak membatalkan pesanan orang lain.');
        }

        // 3. Eksekusi hapus data dari database
        $booking->delete();

        // 4. Balikin user ke halaman riwayat bawa pesan sukses
        return redirect()->route('booking.index')->with('success', 'Jadwal berhasil dibatalkan. Uang Anda (pura-puranya) sudah dikembalikan!');
    }
}
