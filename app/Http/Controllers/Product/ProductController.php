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
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:50',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 50 ký tự.',

            'description.max' => 'Mô tả của bạn đã hơn 1000 kí tự',

            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
            'Giá sản phẩm không được vượt quá 99,999,999.99.',

            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',

            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',

            'image.image' => 'Ảnh sản phẩm phải là tệp hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng: JPEG, PNG, JPG hoặc GIF.',
            'image.required' => 'Vui lòng chọn ảnh cho sản phẩm'
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id', 'brand_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $mimeType = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();

            if (!str_starts_with($mimeType, 'image/') || !in_array(strtolower($extension), ['jpeg', 'png', 'jpg', 'gif'])) {
                return back()->withErrors(['image' => 'File phải là hình ảnh hợp lệ (JPEG, PNG, JPG, GIF).']);
            }

            // Lưu ảnh mới
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            Storage::putFileAs('product', $file, $imageName);

            // Lưu đường dẫn vào database
            $data['image'] = 'storage/product/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'description' => 'nullable|string|max',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.min' => 'Tên sản phẩm không ít hơn 3 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 50 ký tự.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
            'price.max' => 'Giá sản phẩm không được vượt quá 99,999,999.99.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'description.max' => 'Mô tả của bạn đã hơn 1000 kí tự',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // 🔹 Kiểm tra MIME Type và phần mở rộng để ngăn chặn PDF hoặc file giả dạng ảnh
            $mimeType = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();

            if (!str_starts_with($mimeType, 'image/') || !in_array(strtolower($extension), ['jpeg', 'png', 'jpg', 'gif'])) {
                return back()->withErrors(['image' => 'File phải là hình ảnh hợp lệ (JPEG, PNG, JPG, GIF).']);
            }

            // 🔹 Xóa ảnh cũ nếu có
            if ($product->image) {
                $imagePath = str_replace('storage/', '', $product->image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // 🔹 Upload ảnh mới
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = $file->storeAs('product', $fileName, 'public');
            $product->image = 'storage/' . $path;
        }

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
