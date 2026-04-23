<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Retrieve users with successful bookings and calculate their total play time in a more efficient way
        $topUsers = User::with(['bookings' => function($query) {
                $query->where('status', 'success');
            }])
            ->get()
            ->map(function($user) {
                $totalMinutes = $user->bookings->sum(function($booking) {
                    $start = \Carbon\Carbon::parse($booking->start_time);
                    $end = \Carbon\Carbon::parse($booking->end_time);
                    return $end->diffInMinutes($start);
                });
                $user->total_hours = round($totalMinutes / 60, 1);
                $user->bookings_count = $user->bookings->count();
                return $user;
            })
            ->filter(function($user) {
                return $user->bookings_count > 0;
            })
            ->sortByDesc('total_hours')
            ->values();

        return view('leaderboard.index', compact('topUsers'));
    }
}
