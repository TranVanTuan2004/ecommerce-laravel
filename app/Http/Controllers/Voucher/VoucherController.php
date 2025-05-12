<?php

namespace App\Http\Controllers\Voucher;
use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Product;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    public function index()
    {
        $vouchers = Coupons::latest()->paginate(10);
        return view('admin.pages.voucher.index', compact('vouchers'));
    }
    public function create()
    {
        return view('admin.pages.voucher.createVoucher');

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'discount' => 'required|integer|min:1|max:100',
            'expiration_date' => 'required|date|',
        ]);

        return redirect()->back()->with('success', 'Tạo voucher thành công!');
    }
}