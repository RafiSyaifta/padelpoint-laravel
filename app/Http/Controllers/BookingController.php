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

    public function store(Request $request, $court_id) // Pastikan $court_id ada di sini
    {
        // Cek input dulu
        // dd($request->all(), $court_id);

        // Query cek bentrok
        $check = Booking::where('court_id', $court_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                    ->where('end_time', '>', $request->start_time);
                })->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>=', $request->end_time);
                });
            });

        // LIHAT HASILNYA: Kalau muncul "true", berarti logika bentrok lu bener tapi datanya emang tabrakan
        // dd($check->exists());

        if ($check->exists()) {
            return back()->with('error', 'Jadwal sudah terisi bro!')->withInput();
        }

        // Kalau lolos, coba simpan
        Booking::create([
            'user_id' => auth()->id(),
            'court_id' => $court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $request->total_price,
            'status' =>  'pending',
        ]);

        // Logika Redirect Pintar
        if (auth()->user()->role === 'admin') {
            // Kalau yang booking Admin, balik ke Panel Admin
            return redirect()->route('admin.dashboard')->with('success', 'Booking berhasil dicatat ke sistem!');
        }

        return redirect()->route('booking.index')->with('success', 'Booking Aman!');
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
