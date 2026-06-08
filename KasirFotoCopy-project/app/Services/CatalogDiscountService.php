<?php

namespace App\Services;

use App\Repositories\CatalogDiscountRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class CatalogDiscountService
{
    protected $catalogDiscountRepository;

    public function __construct(CatalogDiscountRepository $catalogDiscountRepository)
    {
        $this->catalogDiscountRepository = $catalogDiscountRepository;
    }

    public function getAllDiscounts()
    {
        try {
            return $this->catalogDiscountRepository->getAll();
        } catch (Exception $e) {
            Log::error('Error fetching catalog discounts: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getDiscountById($id)
    {
        try {
            return $this->catalogDiscountRepository->getById($id);
        } catch (Exception $e) {
            Log::error('Error fetching catalog discount by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createDiscount(array $data)
    {
        try {
            return $this->catalogDiscountRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error creating catalog discount: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateDiscount($id, array $data)
    {
        try {
            $discount = $this->catalogDiscountRepository->getById($id);
            if (!$discount) {
                throw new Exception("Katalog Diskon tidak ditemukan.");
            }
            
            return $this->catalogDiscountRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Error updating catalog discount: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteDiscount($id)
    {
        try {
            $discount = $this->catalogDiscountRepository->getById($id);
            if (!$discount) {
                throw new Exception("Katalog Diskon tidak ditemukan.");
            }

            return $this->catalogDiscountRepository->delete($id);
        } catch (Exception $e) {
            Log::error('Error deleting catalog discount: ' . $e->getMessage());
            throw $e;
        }
    }
}