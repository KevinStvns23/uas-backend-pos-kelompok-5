<?php

namespace App\Services;

use App\Repositories\DiscountRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class DiscountService
{
    protected $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function getAllDiscounts()
    {
        try {
            return $this->discountRepository->getAll();
        } catch (Exception $e) {
            Log::error('Error fetching discounts: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getDiscountById($id)
    {
        try {
            return $this->discountRepository->getById($id);
        } catch (Exception $e) {
            Log::error('Error fetching discount by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createDiscount(array $data)
    {
        try {
            return $this->discountRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error creating discount: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateDiscount($id, array $data)
    {
        try {
            $discount = $this->discountRepository->getById($id);
            if (!$discount) {
                throw new Exception("Diskon tidak ditemukan.");
            }
            
            return $this->discountRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Error updating discount: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteDiscount($id)
    {
        try {
            $discount = $this->discountRepository->getById($id);
            if (!$discount) {
                throw new Exception("Diskon tidak ditemukan.");
            }

            return $this->discountRepository->delete($id);
        } catch (Exception $e) {
            Log::error('Error deleting discount: ' . $e->getMessage());
            throw $e;
        }
    }
}