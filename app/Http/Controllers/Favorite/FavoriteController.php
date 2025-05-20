<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            toastr()->info('Vui lòng đăng nhập');
            return redirect()->route('login');
        }
        $favorites = $user->wishlist()->with('category')->paginate(8);
        return view('client.pages.favorite.index', compact('favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $product_id = $request->product_id;

        $user = Auth::user();

        if ($user->wishlist->contains($product_id)) {
            $user->wishlist()->detach($product_id);
            toastr()->info('Đã xóa yêu thích');
        } else {
            $user->wishlist()->attach($product_id);
            toastr()->success('Đã thêm yêu thích');
        }
        return back();
    }
}
