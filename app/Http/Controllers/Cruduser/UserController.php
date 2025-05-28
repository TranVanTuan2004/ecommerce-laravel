<?php

namespace App\Http\Controllers\Cruduser;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        // Lấy page hiện tại từ request, mặc định 1
        $page = $request->input('page', 1);

        // Kiểm tra page là số nguyên dương
        if (!ctype_digit(strval($page)) || (int) $page < 1) {
            return redirect()->route('users.index')
                ->with('error', 'URL không hợp lệ');
        }

        $perPage = 10;
        $total = $query->count();
        $maxPage = (int) ceil($total / $perPage);

        if ((int) $page > $maxPage && $total > 0) {
            return redirect()->route('users.index')
                ->with('error', 'Trang yêu cầu không tồn tại');
        }

        $users = $query->latest()->paginate($perPage, ['*'], 'page', $page)->withQueryString();

        return view('admin.pages.crud_user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.crud_user.createUser');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|regex:/^\d{10,11}$/|unique:users,phone',
            'address' => 'required|string|max:250',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.unique' => 'Tên người dùng đã tồn tại',
            'name.string' => 'Vui lòng nhập họ tên là kí tự',
            'name.min' => 'Tên tối thiểu phải có 3 kí tự',
            'name.max' => 'Tên tối đa chỉ được 255 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại,vui lòng thử lại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Vui lòng nhập password là kí tự',
            'password.min' => 'Password phải có tối thiểu 6 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'phone.regex' => 'Vui lòng nhập số điện thoại từ 10 đến 11 chữ số',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.string' => 'Vui lòng nhập định dạng kí tự cho địa chỉ',
            'address.max' => 'Tối đa chỉ 250 kí tự cho địa chỉ',
            'avatar.required' => 'Vui lòng thêm ảnh đại diện',
            'avatar.mimes' => 'Chỉ định dạng png,jpg,jpeg mới được chấp nhận',
            'avatar.max' => 'Tối đa 2mb cho dung lượng ảnh',
            'avatar.image' => 'Vui lòng chọn định dạng ảnh cho ảnh đại diện'
        ]);

        // Upload file avatar
        $file = $request->file('avatar');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('avatars', $fileName, 'public');

        // Tạo user mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 1,
            'avatar' => $path,
        ]);

        return redirect()->route('users.index')->with('success', 'Tạo user thành công');
    }


    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::query()->find($id);

            if (!$user) {
                return redirect()->route('users.index')->with('error', 'Người dùng không tồn tại hoặc đã bị xóa');
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Xóa không hợp lệ ' . $th->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        if (!ctype_digit($id)) {
            abort(404);
        }

        $user = User::findOrFail($id);
        return view('admin.pages.crud_user.editUser', compact('user'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        if (!ctype_digit($id)) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => ['required', 'regex:/^\d{10,11}$/'],
            'address' => 'required|string|max:250',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.string' => 'Vui lòng nhập họ tên là kí tự',
            'name.min' => 'Tên tối thiểu phải có 3 kí tự',
            'name.max' => 'Tên tối đa chỉ được 255 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại, vui lòng thử lại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Vui lòng nhập số điện thoại từ 10 đến 11 chữ số',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.string' => 'Vui lòng nhập định dạng kí tự cho địa chỉ',
            'address.max' => 'Tối đa chỉ 250 kí tự cho địa chỉ',
            'avatar.mimes' => 'Chỉ định dạng png, jpg, jpeg mới được chấp nhận',
            'avatar.max' => 'Tối đa 2MB cho dung lượng ảnh',
            'avatar.image' => 'Vui lòng chọn định dạng ảnh hợp lệ cho ảnh đại diện',
        ]);

        $user = User::findOrFail($id);
        if ($request->updated_at !== $user->updated_at->toIso8601String()) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Tải lại trang trước khi update']);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $path;
        } else if ($request->input('remove_avatar')) {
            // Nếu user chọn xóa avatar (ví dụ 1 checkbox hoặc nút xóa)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = 'storage/avatars/clone.png';  // Hoặc gán string mặc định nếu muốn
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Cập nhật thành công');
    }


}
