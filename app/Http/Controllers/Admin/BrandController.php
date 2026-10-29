<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'BrandName' => 'required|max:100',
            'Country' => 'nullable|max:100',
            'Logo' => 'nullable|max:255',
            'Description' => 'nullable',
            'Status' => 'required|boolean',
        ]);

        Brand::create([
            'BrandName' => $request->BrandName,
            'Country' => $request->Country,
            'Logo' => $request->Logo,
            'Description' => $request->Description,
            'Status' => $request->Status,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'BrandName' => 'required|max:100',
            'Country' => 'nullable|max:100',
            'Logo' => 'nullable|max:255',
            'Description' => 'nullable',
            'Status' => 'required|boolean',
        ]);

        $brand = Brand::findOrFail($id);

        $brand->update([
            'BrandName' => $request->BrandName,
            'Country' => $request->Country,
            'Logo' => $request->Logo,
            'Description' => $request->Description,
            'Status' => $request->Status,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}