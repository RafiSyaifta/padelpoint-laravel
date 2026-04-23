<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
            'court_id' => 'required|exists:courts,id'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'court_id' => $request->court_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda telah berhasil terkirim.');
    }
}
