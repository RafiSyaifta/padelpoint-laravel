<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;
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

    public function store(Request $request, $court_id)
    {
        // 1. Validasi Input (Pastikan jam booking masuk akal)
        $request->validate([
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // 2. Cek Bentrok Jam (Logic anti-numpuk)
        $isBentrok = Booking::where('court_id', $court_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['success', 'pending'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })->exists();

        if ($isBentrok) {
            return redirect()->back()->with('error', 'Jam tersebut sudah dipesan orang lain bro!');
        }

        // 3. Ambil data lapangan buat dapet harga per jam
        $court = \App\Models\Court::findOrFail($court_id);

        // 4. Hitung Durasi & Total Harga
        $startTime = \Carbon\Carbon::parse($request->start_time);
        $endTime = \Carbon\Carbon::parse($request->end_time);
        $durasiJam = $startTime->diffInHours($endTime);

        // Jaga-jaga kalau durasinya kurang dari 1 jam (dibulatin jadi 1 jam)
        if ($durasiJam == 0) {
            $durasiJam = 1;
        }

        // Ini dia total harganya!
        $total_price = $court->price_per_hour * $durasiJam;

        // 5. Simpan data booking ke database (SEKARANG TOTAL PRICE UDAH MASUK)
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'court_id' => $court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $total_price, // <--- INI OBAT ERRORNYA
            'status' => 'pending',
        ]);

        // 6. Konfigurasi Midtrans (Pakai namespace penuh biar gak error)
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 7. Siapin data tagihan buat dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                // Bikin order_id unik gabungan kata PADEL, ID Booking, dan Waktu
                'order_id' => 'PADEL-' . $booking->id . '-' . time(),
                'gross_amount' => $total_price, // <--- Pake total harga yang dihitung tadi
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        // 8. Minta "Snap Token" ke Midtrans dan simpan ke database
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $booking->update(['snap_token' => $snapToken]);

        // 9. Lempar user ke halaman Riwayat Booking
        return redirect()->route('booking.index')->with('success', 'Booking berhasil! Silakan selesaikan pembayaran.');
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

    // Di dalam class BookingController

    public function uploadProof(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Cari data booking-nya
        $booking = Booking::findOrFail($id);

        // 3. Proses simpan file
        if ($request->hasFile('payment_proof')) {
            // Simpan ke storage/app/public/proofs
            $path = $request->file('payment_proof')->store('proofs', 'public');

            // 4. Update path di database
            $booking->update([
                'payment_proof' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Bukti transfer berhasil dikirim! Mohon tunggu konfirmasi admin.');
    }

    public function getJadwal($court_id)
    {
        // Ambil booking yang statusnya success (merah) atau pending (kuning)
        $bookings = \App\Models\Booking::where('court_id', $court_id)
            ->whereIn('status', ['success', 'pending'])
            ->get()
            ->map(function ($booking) {
                return [
                    'title' => $booking->status == 'success' ? 'Dibooking (Penuh)' : 'Menunggu Bayar',
                    'start' => $booking->booking_date . 'T' . $booking->start_time,
                    'end'   => $booking->booking_date . 'T' . $booking->end_time,
                    'color' => $booking->status == 'success' ? '#EF4444' : '#F59E0B', // Merah / Kuning
                    'textColor' => '#ffffff'
                ];
            });

        return response()->json($bookings);
    }

    /**
     * Webhook untuk menerima notifikasi otomatis dari Midtrans
     */
    public function midtransCallback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');

        // 1. Validasi Keamanan: Pastikan request ini BENERAN dari Midtrans
        // Rumus Midtrans: SHA512(order_id + status_code + gross_amount + server_key)
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {

            // 2. Ambil ID Booking asli dari order_id (Format kita kemarin: PADEL-{id}-{time})
            // Kita pecah stringnya pake '-' dan ambil index ke-1
            $orderIdParts = explode('-', $request->order_id);
            $bookingId = $orderIdParts[1];

            $booking = Booking::find($bookingId);

            if (!$booking) {
                return response()->json(['message' => 'Booking tidak ditemukan'], 404);
            }

            // 3. Cek status dari Midtrans dan update database
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // LUNAS!
                $booking->update(['status' => 'success']);
            } elseif (in_array($request->transaction_status, ['deny', 'cancel', 'expire'])) {
                // GAGAL / KADALUARSA
                $booking->update(['status' => 'canceled']);
            }

            // Balas ke Midtrans dengan status 200 (OK) biar kurirnya pulang
            return response()->json(['message' => 'Notifikasi berhasil diproses']);
        }

        // Kalau signature beda, usir! (Indikasi Hacker)
        return response()->json(['message' => 'Signature tidak valid!'], 403);
    }
}
