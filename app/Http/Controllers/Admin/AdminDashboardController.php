<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Booking::where('status', 'success')->sum('total_price');
        $todayBookings = Booking::whereDate('created_at', today())->count();
        $totalUsers = User::where('role', 'user')->count();
        $allBookings = Booking::with(['user', 'court'])->latest()->get();

        return view('admin.dashboard', compact('allBookings', 'totalRevenue', 'todayBookings', 'totalUsers'));
    }

    public function courts()
    {
        $courts = Court::all();
        return view('admin.courts.index', compact('courts'));
    }

    public function createCourt()
    {
        return view('admin.courts.create');
    }

    public function storeCourt(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courts', 'public');
            $data['image'] = $path;
        }

        Court::create($data);

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan baru berhasil ditambahkan.');
    }

    public function editCourt($id)
    {
        $court = Court::findOrFail($id);
        return view('admin.courts.edit', compact('court'));
    }

    public function updateCourt(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $court = Court::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courts', 'public');
            $data['image'] = $path;
        }

        $court->update($data);

        return redirect()->route('admin.courts.index')->with('success', 'Data lapangan berhasil diperbarui.');
    }

    public function destroyCourt($id)
    {
        $court = Court::findOrFail($id);
        $court->delete();

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan telah dihapus dari sistem.');
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Data booking telah dihapus secara permanen.');
    }

    public function confirmPayment($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => 'success'
        ]);

        return redirect()->back()->with('success', 'Pembayaran untuk booking #' . $id . ' telah berhasil dikonfirmasi.');
    }
}
