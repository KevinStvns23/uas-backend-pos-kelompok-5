<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('discounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'promo_name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'is_active' => 'required|boolean',
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')->with('success', 'Promo diskon berhasil ditambahkan.');
    }

    public function edit(Discount $discount)
    {
        return view('discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'promo_name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'is_active' => 'required|boolean',
        ]);

        $discount->update($request->all());

        return redirect()->route('discounts.index')->with('success', 'Data diskon berhasil diupdate.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Promo diskon berhasil dihapus.');
    }
}