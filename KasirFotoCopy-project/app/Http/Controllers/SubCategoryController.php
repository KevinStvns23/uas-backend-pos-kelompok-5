<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use App\Services\CategoryService;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $categoryService;

    public function __construct(SubCategoryService $subCategoryService, CategoryService $categoryService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $subCategories = $this->subCategoryService->getAllSubCategories();
        $categories = $this->categoryService->getAllCategories();
        
        return view('sub-categories', compact('subCategories', 'categories'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->subCategoryService->createSubCategory($validated);
        
        return redirect()->route('sub-categories.index')->with('success', 'Sub Kategori berhasil dibuat');
    }

    public function show($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        if (!$subCategory) {
            return redirect()->route('sub-categories.index')->with('error', 'Sub Kategori tidak ditemukan');
        }
        return view('sub-categories_show', compact('subCategory'));
    }

    public function edit($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        if (!$subCategory) {
            return redirect()->route('sub-categories.index')->with('error', 'Sub Kategori tidak ditemukan');
        }
        $categories = $this->categoryService->getAllCategories();
        return view('sub-categories_edit', compact('subCategory', 'categories'));
    }

    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $this->subCategoryService->updateSubCategory($id, $validated);
        
        return redirect()->route('sub-categories.index')->with('success', 'Sub Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $this->subCategoryService->deleteSubCategory($id);
        
        return redirect()->route('sub-categories.index')->with('success', 'Sub Kategori berhasil dihapus');
    }
}