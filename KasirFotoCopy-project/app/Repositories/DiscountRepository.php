<?php

namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository
{
    public function getAll()
    {
        return Discount::with('products')->get();
    }

    public function getById($id)
    {
        return Discount::with('products')->find($id);
    }

    public function create(array $data)
    {
        return Discount::create($data);
    }

    public function update($id, array $data)
    {
        $discount = Discount::find($id);
        if ($discount) {
            $discount->update($data);
            return $discount;
        }
        return null;
    }

    public function delete($id)
    {
        $discount = Discount::find($id);
        if ($discount) {
            return $discount->delete();
        }
        return false;
    }
}