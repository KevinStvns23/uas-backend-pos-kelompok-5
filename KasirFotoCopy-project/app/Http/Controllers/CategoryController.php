<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Exception;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = $this->categoryService->createCategory($validated);
        
        return response()->json([
            'message' => 'Kategori berhasil dibuat', 
            'data' => new CategoryResource($category)
        ], 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $category = $this->categoryService->updateCategory($id, $validated);
            
            return response()->json([
                'message' => 'Kategori berhasil diubah', 
                'data' => new CategoryResource($category)
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            
            return response()->json(['message' => 'Kategori berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}