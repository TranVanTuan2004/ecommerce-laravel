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
            'code' => 'required|max:20',
            'discount' => 'required|integer|min:1|max:100',
            'expiration_date' => 'required|date|after_or_equal:today',
            'description' => 'nullable|string|max:255',
        ], [
            'code.required' => 'Mã giảm giá là bắt buộc.',
            'code.max' => 'Mã giảm giá không được vượt quá 20 ký tự.',

            'discount.required' => 'Phần trăm giảm giá là bắt buộc.',
            'discount.integer' => 'Phần trăm giảm giá phải là số nguyên.',
            'discount.min' => 'Phần trăm giảm giá tối thiểu là 1%.',
            'discount.max' => 'Phần trăm giảm giá tối đa là 100%.',

            'expiration_date.required' => 'Ngày hết hạn là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn phải là định dạng ngày hợp lệ.',
            'expiration_date.after_or_equal' => 'Ngày hết hạn phải là ngày hôm nay hoặc ngày trong tương lai.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
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
            'code' => 'required|max:20',
            'discount' => 'required|integer|min:1|max:100',
            'expiration_date' => 'required|date|after_or_equal:today',
            'description' => 'nullable|string|max:255',
        ], [
            'code.required' => 'Mã giảm giá là bắt buộc.',
            'code.max' => 'Mã giảm giá không được vượt quá 20 ký tự.',

            'discount.required' => 'Phần trăm giảm giá là bắt buộc.',
            'discount.integer' => 'Phần trăm giảm giá phải là số nguyên.',
            'discount.min' => 'Phần trăm giảm giá tối thiểu là 1%.',
            'discount.max' => 'Phần trăm giảm giá tối đa là 100%.',

            'expiration_date.required' => 'Ngày hết hạn là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn phải là định dạng ngày hợp lệ.',
            'expiration_date.after_or_equal' => 'Ngày hết hạn phải là ngày hôm nay hoặc ngày trong tương lai.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
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