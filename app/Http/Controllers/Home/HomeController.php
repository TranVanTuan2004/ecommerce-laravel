<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.pages.home.home');
    }

    public function showProduct()
    {
        $products = Product::with('brand')->paginate(8);
        return view('client.pages.home.homeShop', compact('products'));
    }

    public function showProductDetail($id)
    {
        $product = Product::with('brand', 'category')->findOrFail($id);
        return view('client.pages.home.productDetail', compact('product'));
    }
}
