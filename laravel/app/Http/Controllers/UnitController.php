<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        Unit::create($request->all());
        return redirect()->route('units.index')->with('success', 'Satuan barang berhasil ditambahkan.');
    }
    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        $unit->update($request->all());
        return redirect()->route('units.index')->with('success', 'Satuan barang berhasil diperbarui.');
    }
    
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Satuan barang berhasil dihapus.');
    }
}