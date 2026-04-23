<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;

class HomeController extends Controller
{
    public function index()
    {
        $courts = Court::with('reviews.user')->get();

        return view('welcome', compact('courts'));
    }
}
