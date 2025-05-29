<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $brands = Brand::query()->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->latest()->paginate(10);
        return view('admin.pages.brand.index', compact(['brands', 'search']));
    }

    public function create()
    {
        return view('admin.pages.brand.createBrand');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Tên thương hiệu là bắt buộc.',
            'name.string' => 'Tên thương hiệu phải là chuỗi.',
            'name.max' => 'Tên thương hiệu không được vượt quá 50 ký tự.',

            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',

            'logo.image' => 'Logo phải là một tệp hình ảnh.',
            'logo.max' => 'Logo không được vượt quá 2MB.',
        ]);

        try {
            if ($request->hasFile('logo')) {
                $data['logo'] = Storage::put('brands', $request->file('logo'));
            }

            Brand::query()->create($data);
            return redirect()->route('brand.index')->with('success', true);
        } catch (Throwable $th) {
            // các trường hợp chạy vào catch là => nếu mà lỗi không lưu được ảnh ở try or lỗi ko create được dữ liệu dưới database thì nó sẽ ném vào catch và xử lý 
            if (!empty($data['logo'] && Storage::exists($data['logo']))) {
                Storage::delete($data['logo']);
            }
            return back()->with([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $brand = Brand::query()->find($id);
        return view('admin.pages.brand.editBrand', compact('brand'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Tên thương hiệu là bắt buộc.',
            'name.string' => 'Tên thương hiệu phải là chuỗi.',
            'name.max' => 'Tên thương hiệu không được vượt quá 50 ký tự.',

            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',

            'logo.image' => 'Logo phải là một tệp hình ảnh.',
            'logo.max' => 'Logo không được vượt quá 2MB.',
        ]);

        try {
            $brand = Brand::query()->find($request->id);
            if ($brand->updated_at != $request->input('updated_at')) {
                return back()->with([
                    'error' => 'Tải lại trang trước khi update',
                ]);
            }

            if ($request->hasFile('logo')) {
                $data['logo'] = Storage::put('brands', $request->file('logo'));
            }

            $currentLogo = $brand->logo;

            $brand->update($data);

            if ($request->hasFile('logo') && !empty($currentLogo) && Storage::exists($currentLogo)) {
                Storage::delete($currentLogo);
            }
            return redirect()->route('brand.index')->with('success', true);
        } catch (Throwable $th) {
            if (!empty($data['logo']) && Storage::exists($data['logo'])) {
                Storage::delete($data['logo']);
            }
            return back()->with('success', false)->with('error', $th->getMessage());
        }
    }
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;

            $brand = Brand::query()->find($id);
            if ($brand) {
                $brand->delete();
                return back()->with('success', 'Xóa brand ' . $brand->name . ' thành công');
            } else {
                return back()->with('error', 'Brand không tồn tại hoặc đã được xóa');
            }
        } catch (Throwable $th) {
            return back()->with('success', false)->with('error', $th->getMessage());
        }
    }
}
