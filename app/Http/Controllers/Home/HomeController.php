<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $products = Product::latest()->paginate(10);
    //     return view('client.pages.home.home', compact('products'));
    // }

    public function showProduct()
    {
        $products = Product::with('brand')->paginate(8);
        $categories = Category::all();

        return view('client.pages.home.homeShop', compact('products', 'categories'));
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
}
