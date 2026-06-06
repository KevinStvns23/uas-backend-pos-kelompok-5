<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function index()
    {
        $discounts = $this->discountService->getAllDiscounts();
        return view('discounts', compact('discounts'));
    }

    public function store(StoreDiscountRequest $request)
    {
        $validated = $request->validated();
        $this->discountService->createDiscount($validated);
        
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil dibuat');
    }

    public function show($id)
    {
        $discount = $this->discountService->getDiscountById($id);
        if (!$discount) {
            return redirect()->route('discounts.index')->with('error', 'Diskon tidak ditemukan');
        }
        return view('discounts_show', compact('discount'));
    }

    public function update(UpdateDiscountRequest $request, $id)
    {
        $validated = $request->validated();
        $this->discountService->updateDiscount($id, $validated);
        
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil diubah');
    }

    public function destroy($id)
    {
        $this->discountService->deleteDiscount($id);
        
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil dihapus');
    }
}