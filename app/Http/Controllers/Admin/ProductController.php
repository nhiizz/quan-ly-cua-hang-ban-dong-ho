<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::where('Status', 1)->get();
        $categories = Category::where('Status', 1)->get();

        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Brand_ID' => 'required|exists:Brand,Brand_ID',
            'Category_ID' => 'required|exists:Category,Category_ID',
            'ProductName' => 'required|max:150',
            'Description' => 'nullable',
            'MovementType' => 'nullable|max:100',
            'WaterResistance' => 'nullable|max:100',
            'WarrantyPeriod' => 'nullable|max:100',
            'GlassMaterial' => 'nullable|max:100',
            'DialColor' => 'nullable|max:50',
            'StrapMaterial' => 'nullable|max:100',
            'CaseMaterial' => 'nullable|max:100',
            'Gender' => 'nullable|in:Men,Women,Unisex',
            'Quantity' => 'required|integer|min:0',
            'Price' => 'required|numeric|min:0',
            'Status' => 'required|boolean',
        ]);

        Product::create([
            'Brand_ID' => $request->Brand_ID,
            'Category_ID' => $request->Category_ID,
            'ProductName' => $request->ProductName,
            'Description' => $request->Description,
            'MovementType' => $request->MovementType,
            'WaterResistance' => $request->WaterResistance,
            'WarrantyPeriod' => $request->WarrantyPeriod,
            'GlassMaterial' => $request->GlassMaterial,
            'DialColor' => $request->DialColor,
            'StrapMaterial' => $request->StrapMaterial,
            'CaseMaterial' => $request->CaseMaterial,
            'Gender' => $request->Gender,
            'Quantity' => $request->Quantity,
            'Price' => $request->Price,
            'Status' => $request->Status,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $brands = Brand::where('Status', 1)->get();
        $categories = Category::where('Status', 1)->get();

        return view('admin.products.edit', compact(
            'product',
            'brands',
            'categories'
        ));
    }
public function update(Request $request, $id)
    {
        $request->validate([
            'Brand_ID' => 'required|exists:Brand,Brand_ID',
            'Category_ID' => 'required|exists:Category,Category_ID',
            'ProductName' => 'required|max:150',
            'Description' => 'nullable',
            'MovementType' => 'nullable|max:100',
            'WaterResistance' => 'nullable|max:100',
            'WarrantyPeriod' => 'nullable|max:100',
            'GlassMaterial' => 'nullable|max:100',
            'DialColor' => 'nullable|max:50',
            'StrapMaterial' => 'nullable|max:100',
            'CaseMaterial' => 'nullable|max:100',
            'Gender' => 'nullable|in:Men,Women,Unisex',
            'Quantity' => 'required|integer|min:0',
            'Price' => 'required|numeric|min:0',
            'Status' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'Brand_ID' => $request->Brand_ID,
            'Category_ID' => $request->Category_ID,
            'ProductName' => $request->ProductName,
            'Description' => $request->Description,
            'MovementType' => $request->MovementType,
            'WaterResistance' => $request->WaterResistance,
            'WarrantyPeriod' => $request->WarrantyPeriod,
            'GlassMaterial' => $request->GlassMaterial,
            'DialColor' => $request->DialColor,
            'StrapMaterial' => $request->StrapMaterial,
            'CaseMaterial' => $request->CaseMaterial,
            'Gender' => $request->Gender,
            'Quantity' => $request->Quantity,
            'Price' => $request->Price,
            'Status' => $request->Status,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
