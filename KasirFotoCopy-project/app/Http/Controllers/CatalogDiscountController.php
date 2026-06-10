<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogDiscountController extends Controller
{
    public function index()
    {
        $discountedProducts = Product::with('discount')
            ->whereNotNull('discount_id')
            ->whereHas('discount', function ($query) {
                $query->where('is_active', 1);
            })->get();

        return view('catalog-discounts', compact('discountedProducts'));
    }
}