<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
            'court_id' => 'required|exists:courts,id'
        ]);

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'court_id' => $request->court_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Ulasan lu sudah terkirim, bro!');
    }
}
