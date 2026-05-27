<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use Illuminate\Http\Request;
use Exception;

class SubCategoryController extends Controller
{
    protected $subCategoryService;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    public function index()
    {
        $subCategories = $this->subCategoryService->getAllSubCategories();
        
        return response()->json(['data' => $subCategories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $subCategory = $this->subCategoryService->createSubCategory($validated);
        
        return response()->json([
            'message' => 'Sub Kategori berhasil dibuat',
            'data' => $subCategory
        ], 201);
    }

    public function show($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        
        if (!$subCategory) {
            return response()->json(['message' => 'Sub Kategori tidak ditemukan'], 404);
        }
        
        return response()->json(['data' => $subCategory]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string'
        ]);

        try {
            $subCategory = $this->subCategoryService->updateSubCategory($id, $validated);
            
            return response()->json([
                'message' => 'Sub Kategori berhasil diubah',
                'data' => $subCategory
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->subCategoryService->deleteSubCategory($id);
            
            return response()->json(['message' => 'Sub Kategori berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}