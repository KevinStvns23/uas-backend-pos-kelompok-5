<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Unit;    
use App\Models\Discount;  
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Menampilkan semua daftar barang
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) 
        {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->orderBy('name', 'asc')
        ->paginate(5);
    
        return view('products.index', compact('products'));
    }

    // 2. Menampilkan form untuk tambah barang baru
    public function create()
    {
        $units = Unit::all();
        $discounts = Discount::where('is_active', 1)->get(); 

        $categories = Category::all(); 
        $subCategoriesGrouped = SubCategory::with('category')->get()->groupBy('category_id');

        return view('products.create', compact('units', 'discounts', 'categories', 'subCategoriesGrouped'));
    }

    // 3. Menyimpan data barang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'unit_id' => 'required',
            'discount_id' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $categoryId = null;
        if ($request->filled('sub_category_id')) {
            $subCategory = SubCategory::find($request->sub_category_id);
            if ($subCategory) {
                $categoryId = $subCategory->category_id;
            }
        }

        $data = $request->all();
        $data['category_id'] = $categoryId;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Barang ATK berhasil ditambahkan!');
    }

    // 4. Menampilkan detail 1 barang 
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // 5. Menampilkan form untuk mengubah data barang
    public function edit(Product $product)
    {
        $units = Unit::all();
        $discounts = Discount::where('is_active', 1)->get();

        $categories = Category::all(); 
        $subCategoriesGrouped = SubCategory::with('category')->get()->groupBy('category_id');

        return view('products.edit', compact('product', 'units', 'discounts', 'categories', 'subCategoriesGrouped'));
    }

    // 6. Menyimpan perubahan data barang ke database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'unit_id' => 'required',
            'discount_id' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $categoryId = null;
        if ($request->filled('sub_category_id')) {
            $subCategory = SubCategory::find($request->sub_category_id);
            if ($subCategory) {
                $categoryId = $subCategory->category_id;
            }
        }

        $data = $request->all();
        $data['category_id'] = $categoryId;

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Data barang berhasil diupdate!');
    }

    // 7. Menghapus barang
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus.');
    }
}