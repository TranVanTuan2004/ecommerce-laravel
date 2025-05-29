<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    // public function index()
    // {
    //     $products = Product::latest()->paginate(10);
    //     return view('client.pages.home.home', compact('products'));
    // }

    public function showProduct(Request $request)
    {
        $query = Product::with('brand', 'category');

        // Tìm kiếm theo từ khóa (tên và mô tả)
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        // Lọc theo giá
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Lọc theo thương hiệu
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        // Lọc theo danh mục
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Sắp xếp
        if ($request->sort_by) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('views', 'desc');
                    break;
            }
        }

        $perPage = $request->input('per_page', 8);
        // Phân trang với số lượng sản phẩm được chọn + giữ query string
        $products = $query->paginate($perPage)->appends($request->query());

        // Dữ liệu cho dropdown/filter
        $categories = Category::withCount('products')->get();
        $brands = Brand::all();

        return view('client.pages.home.homeShop', compact('products', 'categories', 'brands'));
    }






    public function showProductDetail($id)
    {
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }
        $product = Product::with('brand', 'category')->findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->get();
        return view('client.pages.home.detail', compact('product', 'reviews', 'user'));
    }

    public function storeReview($product_id, Request $request)
    {
        $user_id = Auth::id();
        $request->validate([
            'review_text' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        Review::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'rating' => $request->rating,
            'review_text' => $request->review_text
        ]);
        return redirect()->back()->with('success', 'Đánh giá đã được gửi.');
    }
}
