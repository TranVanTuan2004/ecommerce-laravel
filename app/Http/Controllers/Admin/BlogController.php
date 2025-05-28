<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('admin.pages.blog.index', compact('blogs'));
    }
    public function create()
    {
        return view('admin.pages.blog.createBlog'); // file createBlog.blade.php
    }
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kiểm tra ảnh hợp lệ
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        // Tạo blog mới
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => 'storage/' . $imagePath, // lưu đường dẫn tương đối
            'user_id' => Auth::id(),
        ]);


        return redirect()->route('blog.index')->with('success', 'Blog đã được thêm thành công');
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // Tìm blog theo id
        return view('admin.pages.blog.edit', compact('blog')); // Truyền dữ liệu blog vào view
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blog::findOrFail($id); // Tìm blog theo id

        $blog->title = $request->title;
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog_images', 'public');
            $blog->image = 'storage/' . $path;
        }

        $blog->save(); // Lưu cập nhật

        return redirect()->route('blog.index')->with('success', 'Blog đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        // Tìm blog theo ID
        $blog = Blog::findOrFail($id);

        // Xóa ảnh nếu có
        if ($blog->image) {
            Storage::delete('public/' . basename($blog->image));
        }

        // Xóa blog
        $blog->delete();

        // Chuyển hướng về trang index với thông báo thành công
        return redirect()->route('blog.index')->with('success', 'Blog đã được xóa thành công!');
    }
}
