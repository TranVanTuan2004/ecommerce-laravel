<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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

}
