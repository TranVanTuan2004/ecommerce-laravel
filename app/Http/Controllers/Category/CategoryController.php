<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $categories = $query->paginate(10);
        return view('admin.pages.category.index', compact('categories'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.pages.category.create');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable|max:500',
        ]);

        Category::create($request->only('name', 'description'));

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable|max:500',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'description'));

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công!');
    }
}
