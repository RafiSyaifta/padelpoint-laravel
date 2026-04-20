<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // 1. Halaman Utama Admin (Rekap Semua Booking)
    public function index()
    {
        $allBookings = Booking::with(['user', 'court'])->latest()->get();
        return view('admin.dashboard', compact('allBookings'));
    }

    // 2. Daftar Semua Lapangan
    public function courts()
    {
        $courts = Court::all();
        return view('admin.courts.index', compact('courts'));
    }

    // 3. Munculin Form Tambah Lapangan
    public function createCourt()
    {
        return view('admin.courts.create');
    }

    // 4. Proses Simpan Lapangan Baru
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

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan baru berhasil ditambah!');
    }

    // --- BAGIAN YANG TADI ERROR (PASTIKAN ADA) ---

    // 5. Munculin Form Edit Lapangan
    public function editCourt($id)
    {
        $court = Court::findOrFail($id);
        return view('admin.courts.edit', compact('court'));
    }

    // 6. Proses Simpan Perubahan (Update)
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

        return redirect()->route('admin.courts.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    // 7. Proses Hapus Lapangan
    public function destroyCourt($id)
    {
        $court = Court::findOrFail($id);
        $court->delete();

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan telah dihapus dari sistem!');
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Data booking berhasil dihapus permanen!');
    }
}
