<?php

namespace App\Http\Controllers\Home;

use App\Models\Review;
use App\Models\Product;
use App\Http\Controllers\Controller;

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
        return view('client.pages.home.homeShop', compact('products'));
    }

    public function showProductDetail($id)
    {
        $product = Product::with('brand', 'category')->findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->get();
        return view('client.pages.home.detail', compact('product', 'reviews'));
    }
}
