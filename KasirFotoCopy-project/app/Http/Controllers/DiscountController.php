<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;
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
        return DiscountResource::collection($discounts);
    }

    public function store(StoreDiscountRequest $request)
    {
        $validated = $request->validated();

        $discount = $this->discountService->createDiscount($validated);
        
        return response()->json([
            'message' => 'Diskon berhasil dibuat',
            'data' => new DiscountResource($discount)
        ], 201);
    }

    public function show($id)
    {
        $discount = $this->discountService->getDiscountById($id);
        
        if (!$discount) {
            return response()->json(['message' => 'Diskon tidak ditemukan'], 404);
        }
        return new DiscountResource($discount);
    }

    public function update(UpdateDiscountRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $discount = $this->discountService->updateDiscount($id, $validated);
            return response()->json([
                'message' => 'Diskon berhasil diubah',
                'data' => new DiscountResource($discount)
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