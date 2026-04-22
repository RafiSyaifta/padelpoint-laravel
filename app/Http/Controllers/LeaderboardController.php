<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Ambil user yang punya booking success, hitung total jam mainnya
        $topUsers = User::whereHas('bookings', function($query) {
                $query->where('status', 'success');
            })
            ->withCount(['bookings' => function($query) {
                $query->where('status', 'success');
            }])
            // Kita hitung durasi jam (end_time - start_time)
            ->get()
            ->map(function($user) {
                $totalMinutes = $user->bookings()->where('status', 'success')->get()->sum(function($booking) {
                    $start = \Carbon\Carbon::parse($booking->start_time);
                    $end = \Carbon\Carbon::parse($booking->end_time);
                    return $end->diffInMinutes($start);
                });
                $user->total_hours = round($totalMinutes / 60, 1);
                return $user;
            })
            ->sortByDesc('total_hours')
            ->values();

        return view('leaderboard.index', compact('topUsers'));
    }
}
