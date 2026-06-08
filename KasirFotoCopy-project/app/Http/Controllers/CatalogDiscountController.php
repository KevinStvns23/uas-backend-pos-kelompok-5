<?php

namespace App\Http\Controllers;

use App\Services\CatalogDiscountService;
use App\Http\Requests\StoreCatalogDiscountRequest;
use App\Http\Requests\UpdateCatalogDiscountRequest;

class CatalogDiscountController extends Controller
{
    protected $catalogDiscountService;

    public function __construct(CatalogDiscountService $catalogDiscountService)
    {
        $this->catalogDiscountService = $catalogDiscountService;
    }

    public function index()
    {
        $discounts = $this->catalogDiscountService->getAllDiscounts();
        return view('catalog-discounts', compact('discounts'));
    }

    public function store(StoreCatalogDiscountRequest $request)
    {
        $validated = $request->validated();
        $this->catalogDiscountService->createDiscount($validated);
        
        return redirect()->route('catalog-discounts.index')->with('success', 'Katalog Diskon berhasil dibuat');
    }

    public function update(UpdateCatalogDiscountRequest $request, $id)
    {
        $validated = $request->validated();
        $this->catalogDiscountService->updateDiscount($id, $validated);
        
        return redirect()->route('catalog-discounts.index')->with('success', 'Katalog Diskon berhasil diubah');
    }

    public function destroy($id)
    {
        $this->catalogDiscountService->deleteDiscount($id);
        
        return redirect()->route('catalog-discounts.index')->with('success', 'Katalog Diskon berhasil dihapus');
    }
}