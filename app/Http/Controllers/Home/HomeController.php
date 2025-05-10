<?php

namespace App\Http\Controllers\Home;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function storeReview($product_id, $user_id, Request $request)
    {
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
