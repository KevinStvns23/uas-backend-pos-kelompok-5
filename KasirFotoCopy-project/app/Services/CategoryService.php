<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getCategoryById($id)
    {
        try {
            return $this->categoryRepository->getById($id);
        } catch (Exception $e) {
            Log::error('Error fetching category by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createCategory(array $data)
    {
        try {
            return $this->categoryRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateCategory($id, array $data)
    {
        try {
            return $this->categoryRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteCategory($id)
    {
        try {
            return $this->categoryRepository->delete($id);
        } catch (Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            throw $e;
        }
    }
}