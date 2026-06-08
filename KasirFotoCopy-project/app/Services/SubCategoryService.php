<?php

namespace App\Services;

use App\Repositories\SubCategoryRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class SubCategoryService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getAllSubCategories()
    {
        try {
            return $this->subCategoryRepository->getAll();
        } catch (Exception $e) {
            Log::error('Error fetching sub-categories: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSubCategoryById($id)
    {
        try {
            return $this->subCategoryRepository->getById($id);
        } catch (Exception $e) {
            Log::error('Error fetching sub-category by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createSubCategory(array $data)
    {
        try {
            return $this->subCategoryRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error creating sub-category: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateSubCategory($id, array $data)
    {
        try {
            $subCategory = $this->subCategoryRepository->getById($id);
            if (!$subCategory) {
                throw new Exception("Sub Kategori tidak ditemukan.");
            }
            
            return $this->subCategoryRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Error updating sub-category: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteSubCategory($id)
    {
        try {
            $subCategory = $this->subCategoryRepository->getById($id);
            if (!$subCategory) {
                throw new Exception("Sub Kategori tidak ditemukan.");
            }

            return $this->subCategoryRepository->delete($id);
        } catch (Exception $e) {
            Log::error('Error deleting sub-category: ' . $e->getMessage());
            throw $e;
        }
    }
}