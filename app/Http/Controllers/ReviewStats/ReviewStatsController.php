<?php

namespace App\Http\Controllers\ReviewStats;


use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewStatsController extends Controller
{
    public function allProductRatingStats()
    {
        $products = Product::with([
            'reviews' => function ($query) {
                $query->select('product_id', 'rating')
                    ->groupBy('product_id', 'rating');
            }
        ])->get();

        // Chuẩn bị dữ liệu
        $stats = [];

        foreach ($products as $product) {
            $ratingCounts = array_fill(1, 5, 0); // Khởi tạo 1-5 sao = 0

            foreach ($product->reviews as $review) {
                $count = Review::where('product_id', $product->id)
                    ->where('rating', $review->rating)
                    ->count();
                $ratingCounts[$review->rating] = $count;
            }

            $stats[] = [
                'product_name' => $product->name,
                'product_id' => $product->id,
                'ratings' => $ratingCounts,
            ];
        }

        return view('admin.pages.ProductReviews.productReviews', ['stats' => $stats]);
    }

}
