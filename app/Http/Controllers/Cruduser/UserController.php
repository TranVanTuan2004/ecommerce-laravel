<?php

namespace App\Http\Controllers\Cruduser;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.pages.crud_user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.crud_user.createUser');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|min:10',
            'address' => 'required|max:250',
            'avatar' => 'required|mimes:jpg,png,pdf|max:2048'
        ]);
        $file = $request->file('avatar');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('avatars', $fileName, 'public');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 1,
            'avatar' => $path,
        ]);

        return redirect()->route('users.index')->with('success', 'Thanh Cong');
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::query()->find($id);
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Thanh Cong');
        } catch (Throwable $th) {
            return back()->with('success', false)->with('error', $th->getMessage());

        }

    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::query()->find($id);
        return view('admin.pages.crud_user.editUser', compact('user'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required|max:250',
            'avatar' => 'nullable|mimes:jpg,png,pdf|max:2048' // cho phép không thay avatar
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Nếu có file mới được upload
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload ảnh mới
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Cập nhật thành công');
    }

}
