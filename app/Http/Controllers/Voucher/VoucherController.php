<?php

namespace App\Http\Controllers\Voucher;
use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Illuminate\Http\Request;
use Throwable;

use function PHPUnit\Framework\isEmpty;

class VoucherController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        // $vouchers = Coupons::latest()->paginate(10);

        $vouchers = Coupons::query()->when($search, function ($query, $search) {
            $query->where('code', 'like', "%{$search}%")->orWhere('discount', 'like', "%{$search}%")
                ->orWhere('expiration_date', 'like', "%{$search}%")
                ->orWhere('min_order_value', 'like', "%{$search}%");
        })->latest()->paginate(10);
        return view('admin.pages.voucher.index', compact(['vouchers', 'search']));
    }
    public function create()
    {
        return view('admin.pages.voucher.createVoucher');

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'discount' => 'required|integer|min:1|max:100',
            'expiration_date' => 'required|date|after_or_equal:today',
        ]);
        try {
            $isCode = Coupons::where('code', $data['code'])->exists();
            if ($isCode) {
                toastr()->error('Mã voucher đã tồn tại', [], 'Thông báo');
                return redirect()->back();
            }

            Coupons::create([
                ...$data,
                'min_order_value' => 0
            ]);
            toastr()->success('Tạo mới voucher thành công', [], 'Thông báo');
            return redirect()->route('voucher.index');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi khi tạo voucher. Vui lòng thử lại.');
        }
    }


    public function edit(Request $request)
    {
        $id = $request->id;

        $voucher = Coupons::findOrFail($id);

        return view('admin.pages.voucher.editVoucher', compact('voucher'));
    }


    public function update(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'discount' => 'required|integer|min:1|max:100',
            'expiration_date' => 'required|date|after_or_equal:today',
        ]);
        try {
            $id = $request->id;
            $voucher = Coupons::findOrFail($id);
            $isCode = Coupons::where('code', $data['code'])->where('id', '!=', $id)->exists();
            if ($isCode) {
                toastr()->error('Mã voucher đã tồn tại', [], 'Thông báo');
                return redirect()->back();
            }
            $voucher->update($data);
            toastr()->success('Cập nhật voucher thành công', [], 'Thông báo');
            return redirect()->route('voucher.index');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi khi sửa voucher');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $voucher = Coupons::findOrFail($id);
            if (!$voucher) {
                toastr()->error('Voucher không tồn tại', [], 'Thông báo');
                return redirect()->back();
            }
            $voucher->delete();
            toastr()->success('Xóa voucher thành công', [], 'Thông báo');
            return redirect()->back();
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi khi xóa voucher');
        }
    }
}