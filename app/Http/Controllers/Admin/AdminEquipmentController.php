<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class AdminEquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::all();
        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('admin.equipment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:rental,purchase',
            'description' => 'nullable|string',
        ]);

        Equipment::create($request->all());

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan baru berhasil ditambahkan.');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:rental,purchase',
            'description' => 'nullable|string',
        ]);

        $equipment->update($request->all());

        return redirect()->route('admin.equipment.index')->with('success', 'Data perlengkapan berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan telah dihapus dari sistem.');
    }
}
