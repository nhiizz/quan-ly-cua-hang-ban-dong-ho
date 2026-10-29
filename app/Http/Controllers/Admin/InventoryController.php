<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->get();

        return view('admin.inventories.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::where('Status', 1)->get();

        return view('admin.inventories.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Product_ID' => 'required|exists:Product,Product_ID',
            'ImportQuantity' => 'required|integer|min:0',
            'ExportQuantity' => 'required|integer|min:0',
        ]);

        // Không cho xuất nhiều hơn số lượng nhập
        if ($request->ExportQuantity > $request->ImportQuantity) {
            return back()
                ->withInput()
                ->withErrors([
                    'ExportQuantity' => 'Export quantity cannot be greater than import quantity.'
                ]);
        }

        // Tự động tính Stock Quantity
        $stockQuantity = $request->ImportQuantity - $request->ExportQuantity;

        Inventory::create([
            'Product_ID' => $request->Product_ID,
            'ImportQuantity' => $request->ImportQuantity,
            'ExportQuantity' => $request->ExportQuantity,
            'StockQuantity' => $stockQuantity,
        ]);

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory created successfully.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);

        $products = Product::where('Status', 1)->get();

        return view('admin.inventories.edit', compact(
            'inventory',
            'products'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Product_ID' => 'required|exists:Product,Product_ID',
            'ImportQuantity' => 'required|integer|min:0',
            'ExportQuantity' => 'required|integer|min:0',
        ]);

        // Không cho xuất nhiều hơn số lượng nhập
        if ($request->ExportQuantity > $request->ImportQuantity) {
            return back()
                ->withInput()
                ->withErrors([
                    'ExportQuantity' => 'Export quantity cannot be greater than import quantity.'
                ]);
        }

        // Tự động tính Stock Quantity
        $stockQuantity = $request->ImportQuantity - $request->ExportQuantity;

        $inventory = Inventory::findOrFail($id);

        $inventory->update([
            'Product_ID' => $request->Product_ID,
            'ImportQuantity' => $request->ImportQuantity,
            'ExportQuantity' => $request->ExportQuantity,
'StockQuantity' => $stockQuantity,
        ]);

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        $inventory->delete();

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory deleted successfully.');
    }
}
