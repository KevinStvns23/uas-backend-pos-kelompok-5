<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

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
        return view('categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->categoryService->createCategory($validated);
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat');
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan');
        }
        return view('categories_show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan');
        }
        return view('categories_edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $this->categoryService->updateCategory($id, $validated);
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}