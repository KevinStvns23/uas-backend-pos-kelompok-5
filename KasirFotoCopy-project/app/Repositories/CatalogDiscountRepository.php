<?php

namespace App\Repositories;

use App\Models\CatalogDiscount;

class CatalogDiscountRepository
{
    public function getAll()
    {
        return CatalogDiscount::with('products')->get();
    }

    public function getById($id)
    {
        return CatalogDiscount::with('products')->find($id);
    }

    public function create(array $data)
    {
        return CatalogDiscount::create($data);
    }

    public function update($id, array $data)
    {
        $discount = CatalogDiscount::find($id);
        if ($discount) {
            $discount->update($data);
            return $discount;
        }
        return null;
    }

    public function delete($id)
    {
        $discount = CatalogDiscount::find($id);
        if ($discount) {
            return $discount->delete();
        }
        return false;
    }
}