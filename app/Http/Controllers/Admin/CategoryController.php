<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    // Lưu Category mới
    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|max:100',
            'Description' => 'nullable',
        ]);

        Category::create([
            'CategoryName' => $request->CategoryName,
            'Description' => $request->Description,
            'Status' => 1,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }

    // Hiển thị form sửa Category
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật Category
    public function update(Request $request, $id)
    {
        $request->validate([
            'CategoryName' => 'required|max:100',
            'Description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'CategoryName' => $request->CategoryName,
            'Description' => $request->Description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Xóa Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}