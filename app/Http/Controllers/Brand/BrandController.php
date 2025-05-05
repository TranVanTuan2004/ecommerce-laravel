<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.pages.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.createBrand');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image'
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
            'name' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image'
        ]);

        try {
            $id = $request->id;
            $brand = Brand::query()->find($id);

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
            $brand->delete();

            return back()->with('success', true);
        } catch (Throwable $th) {
            return back()->with('success', false)->with('error', $th->getMessage());
        }
    }
}
