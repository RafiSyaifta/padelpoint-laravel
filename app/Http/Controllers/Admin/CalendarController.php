<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Menampilkan halaman kalender global admin.
     */
    public function index()
    {
        return view('admin.calendar');
    }

    /**
     * Mengambil semua data jadwal dari semua lapangan untuk FullCalendar.
     */
    public function getGlobalJadwal()
    {
        $bookings = Booking::with(['court', 'user'])
            ->whereIn('status', ['success', 'pending'])
            ->get()
            ->map(function ($booking) {
                // Format Judul: Nama Lapangan | Nama Pemesan
                $title = $booking->court->name . ' | ' . $booking->user->name;

                return [
                    'title' => $title,
                    'start' => $booking->booking_date . 'T' . $booking->start_time,
                    'end'   => $booking->booking_date . 'T' . $booking->end_time,
                    // Indigo untuk sukses, Amber untuk pending
                    'color' => $booking->status == 'success' ? '#4F46E5' : '#F59E0B',
                    'textColor' => '#ffffff'
                ];
            });

        return response()->json($bookings);
    }
}
