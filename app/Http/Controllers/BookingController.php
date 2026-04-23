<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $court = Court::findOrFail($court_id);
        $equipment = \App\Models\Equipment::all();
        return view('booking.create', compact('court', 'equipment'));
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('court')
            ->latest()
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function store(Request $request, $court_id)
    {
        $request->validate([
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'equipment' => 'nullable|array',
            'equipment.*' => 'integer|min:0|max:10',
        ]);

        // Check for existing bookings at the same time and date
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
            return redirect()->back()->with('error', 'Jadwal tersebut sudah dipesan oleh pengguna lain.');
        }

        $court = Court::findOrFail($court_id);

        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $durasiJam = $startTime->diffInHours($endTime);

        if ($durasiJam == 0) {
            $durasiJam = 1;
        }

        // Calculate basic court price
        $total_price = $court->price_per_hour * $durasiJam;

        // Process equipment and calculate prices
        $equipmentData = [];
        if ($request->has('equipment')) {
            foreach ($request->equipment as $id => $quantity) {
                if ($quantity > 0) {
                    $item = \App\Models\Equipment::find($id);
                    if ($item) {
                        $subtotal = $item->price * $quantity;
                        $total_price += $subtotal;
                        $equipmentData[$id] = [
                            'quantity' => $quantity,
                            'subtotal' => $subtotal
                        ];
                    }
                }
            }
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'court_id' => $court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        // Sync equipment to pivot table
        if (!empty($equipmentData)) {
            $booking->equipment()->sync($equipmentData);
        }

        // Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'PADEL-' . $booking->id . '-' . time(),
                'gross_amount' => $total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $booking->update(['snap_token' => $snapToken]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil! Silakan selesaikan pembayaran.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk membatalkan pesanan ini.');
        }

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Jadwal berhasil dibatalkan.');
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('proofs', 'public');
            $booking->update([
                'payment_proof' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah! Mohon menunggu konfirmasi admin.');
    }

    public function getJadwal($court_id)
    {
        $bookings = Booking::where('court_id', $court_id)
            ->whereIn('status', ['success', 'pending'])
            ->get()
            ->map(function ($booking) {
                return [
                    'title' => $booking->status == 'success' ? 'Sudah Dipesan' : 'Menunggu Pembayaran',
                    'start' => $booking->booking_date . 'T' . $booking->start_time,
                    'end'   => $booking->booking_date . 'T' . $booking->end_time,
                    'color' => $booking->status == 'success' ? '#EF4444' : '#F59E0B',
                    'textColor' => '#ffffff'
                ];
            });

        return response()->json($bookings);
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $orderIdParts = explode('-', $request->order_id);
            $bookingId = $orderIdParts[1];

            $booking = Booking::find($bookingId);

            if (!$booking) {
                return response()->json(['message' => 'Data booking tidak ditemukan'], 404);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $booking->update(['status' => 'success']);
            } elseif (in_array($request->transaction_status, ['deny', 'cancel', 'expire'])) {
                $booking->update(['status' => 'canceled']);
            }

            return response()->json(['message' => 'Notifikasi berhasil diproses']);
        }

        return response()->json(['message' => 'Signature tidak valid!'], 403);
    }
}
