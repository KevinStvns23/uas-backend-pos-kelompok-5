<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use Illuminate\Http\Request;
use Exception;

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
        return response()->json(['data' => $discounts]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        $discount = $this->discountService->createDiscount($validated);
        
        return response()->json([
            'message' => 'Diskon berhasil dibuat',
            'data' => $discount
        ], 201);
    }

    public function show($id)
    {
        $discount = $this->discountService->getDiscountById($id);
        
        if (!$discount) {
            return response()->json(['message' => 'Diskon tidak ditemukan'], 404);
        }
        return response()->json(['data' => $discount]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'percentage' => 'sometimes|required|numeric|min:0|max:100'
        ]);

        try {
            $discount = $this->discountService->updateDiscount($id, $validated);
            return response()->json([
                'message' => 'Diskon berhasil diubah',
                'data' => $discount
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->discountService->deleteDiscount($id);
            return response()->json(['message' => 'Diskon berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
} 