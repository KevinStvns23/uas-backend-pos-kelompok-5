<?php

namespace App\Repositories;

use App\Models\SubCategory;

class SubCategoryRepository
{
    public function getAll()
    {
        return SubCategory::with('category')->get();
    }

    public function getById($id)
    {
        return SubCategory::with('category')->find($id);
    }

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    public function update($id, array $data)
    {
        $subCategory = SubCategory::find($id);
        if ($subCategory) {
            $subCategory->update($data);
            return $subCategory;
        }
        return null;
    }

    public function delete($id)
    {
        $subCategory = SubCategory::find($id);
        if ($subCategory) {
            return $subCategory->delete();
        }
        return false;
    }
}