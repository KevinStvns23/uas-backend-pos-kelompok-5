<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;    
use App\Models\Discount;  
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Menampilkan semua daftar barang
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('products.index', compact('products'));
    }

    // 2. Menampilkan form untuk tambah barang baru
    public function create()
    {
        $units = Unit::all();
        $discounts = Discount::where('is_active', 1)->get(); 
        return view('products.create', compact('units', 'discounts'));
    }

    // 3. Menyimpan data barang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'unit_id' => 'required',
            'discount_id' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());

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
        return view('products.edit', compact('product', 'units', 'discounts'));
    }

    // 6. Menyimpan perubahan data barang ke database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'unit_id' => 'required',
            'discount_id' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Data barang berhasil diupdate!');
    }

    // 7. Menghapus barang
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus.');
    }
}