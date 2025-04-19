<?php

namespace App\Http\Controllers\Cruduser;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Throwable;
use function Laravel\Prompts\error;

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
            'address' => 'required|max:250'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 1,
        ]);

        return redirect()->route('users.index')->with('success', 'Hahaha');
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::query()->find($id);
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Hahaha');
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
        $user = User::query()->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('users.index')->with('success', 'hahhaaa');
    }
}
