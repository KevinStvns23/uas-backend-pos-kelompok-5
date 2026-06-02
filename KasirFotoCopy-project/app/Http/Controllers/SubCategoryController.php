<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
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
        
        return SubCategoryResource::collection($subCategories);
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $validated = $request->validated();

        $subCategory = $this->subCategoryService->createSubCategory($validated);
        
        return response()->json([
            'message' => 'Sub Kategori berhasil dibuat',
            'data' => new SubCategoryResource($subCategory)
        ], 201);
    }

    public function show($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        
        if (!$subCategory) {
            return response()->json(['message' => 'Sub Kategori tidak ditemukan'], 404);
        }
        
        return new SubCategoryResource($subCategory);
    }

    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $subCategory = $this->subCategoryService->updateSubCategory($id, $validated);
            
            return response()->json([
                'message' => 'Sub Kategori berhasil diubah',
                'data' => new SubCategoryResource($subCategory)
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