<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with(['category', 'brand']) // eager load để tránh N+1 query
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(6);

        return view('admin.pages.product.index', compact('products'));
    }

    //create product
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.pages.product.createProduct', compact('categories', 'brands'));
    }

    //edit product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.pages.product.edit', compact('product', 'categories', 'brands'));
    }

    //delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id', 'brand_id']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Lưu ảnh vào storage/app/public/product/
            Storage::putFileAs('product', $image, $imageName);

            // Lưu đường dẫn đúng vào database
            $data['image'] = 'storage/product/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // if ($request->hasFile('avatar')) {
        //     // Xóa ảnh cũ nếu tồn tại
        //     if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        //         Storage::disk('public')->delete($user->avatar);
        //     }

        //     // Upload ảnh mới
        //     $file = $request->file('avatar');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $path = $file->storeAs('avatars', $fileName, 'public');
        //     $user->avatar = $path;
        // }

        if ($product->image) {
            $imagePath = str_replace('storage/', '', $product->image); // Chuyển đường dẫn đúng format
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath); // Xóa ảnh cũ
            }
        }

        // Lưu ảnh mới
        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('product', $file, $fileName);

        // Cập nhật đường dẫn ảnh mới vào database
        $product->image = 'storage/product/' . $fileName;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function top10Product()
    {
        $topProducts = Product::withSum('orders as total_sold', 'order_products.quantity')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('admin.pages.productStatistics.bestseller', compact('topProducts'));
    }




}
