<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MabarController extends Controller
{
    public function index()
    {
        $openMatches = Booking::where('is_open_match', true)
            ->where('status', 'success') // Only confirmed bookings
            ->where('booking_date', '>=', now()->toDateString())
            ->with(['court', 'user', 'participants'])
            ->get()
            ->filter(function ($booking) {
                return $booking->participants->count() < 4;
            });

        return view('mabar.index', compact('openMatches'));
    }

    public function join(Booking $booking)
    {
        // 1. Check if match is open
        if (!$booking->is_open_match) {
            return back()->with('error', 'Ini bukan pertandingan mabar.');
        }

        // 2. Check if full
        if ($booking->participants()->count() >= 4) {
            return back()->with('error', 'Maaf, slot mabar sudah penuh.');
        }

        // 3. Check if user is already in
        if ($booking->participants()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'Anda sudah bergabung di mabar ini.');
        }

        // 4. Check if user is the owner
        if ($booking->user_id === Auth::id()) {
            return back()->with('error', 'Anda adalah pembuat mabar ini.');
        }

        // 5. Check schedule conflict
        $hasConflict = Auth::user()->participatedMatches()
            ->where('booking_date', $booking->booking_date)
            ->where(function ($query) use ($booking) {
                $query->where('start_time', '<', $booking->end_time)
                      ->where('end_time', '>', $booking->start_time);
            })->exists() 
            || 
            Auth::user()->bookings()
            ->where('booking_date', $booking->booking_date)
            ->whereIn('status', ['success', 'pending'])
            ->where(function ($query) use ($booking) {
                $query->where('start_time', '<', $booking->end_time)
                      ->where('end_time', '>', $booking->start_time);
            })->exists();

        if ($hasConflict) {
            return back()->with('error', 'Jadwal Anda bentrok dengan mabar ini.');
        }

        $booking->participants()->attach(Auth::id());

        return back()->with('success', 'Berhasil bergabung dengan mabar!');
    }

    public function leave(Booking $booking)
    {
        if ($booking->user_id === Auth::id()) {
            return back()->with('error', 'Pemilik mabar tidak bisa keluar. Silakan batalkan booking jika ingin membatalkan.');
        }

        $booking->participants()->detach(Auth::id());

        return back()->with('success', 'Berhasil keluar dari mabar.');
    }
}
