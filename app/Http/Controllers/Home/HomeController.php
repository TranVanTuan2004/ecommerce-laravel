<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    // public function index()
    // {
    //     $products = Product::latest()->paginate(10);
    //     return view('client.pages.home.home', compact('products'));
    // }

    public function showProduct(Request $request)
    {
        $query = Product::with('brand');

        // Xử lý sắp xếp
        if ($request->has('sort_by')) {
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
                case 'discount':
                    $query->orderBy('discount', 'desc');
                    break;
            }
        }

        $products = $query->paginate(8)->appends($request->query());
        $categories = Category::all();
        $brands = Brand::all();

        return view('client.pages.home.homeShop', compact('products', 'categories', 'brands'));
    }



    public function showProductDetail($id)
    {
        $product = Product::with('brand', 'category')->findOrFail($id);
        return view('client.pages.home.detail', compact('product'));
    }
    public function showProductByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products()->paginate(8); // Sử dụng paginate thay vì get

        return view('client.pages.home.products_by_category', compact('category', 'products'));
    }
    public function search(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên và mô tả
        if ($request->keyword) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%");
        }

        // Tìm kiếm theo giá
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Tìm kiếm theo thương hiệu
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        // Tìm kiếm theo danh mục
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Lấy danh sách sản phẩm đã tìm kiếm và phân trang
        $products = $query->with('brand', 'category')->paginate(8);

        // Lấy danh sách thương hiệu và danh mục
        $brands = Brand::all();
        $categories = Category::all();

        // Trả về view và truyền dữ liệu vào
        return view('client.pages.home.search_results', compact('products', 'categories', 'brands'));
    }
}
