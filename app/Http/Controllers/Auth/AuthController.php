<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Tùy theo role redirect về đúng trang
            return Auth::user()->role === 'admin'
                ? redirect('/dashboard')
                : redirect('/');
        }
        return view('client.pages.login.login');
    }

    public function postLogin(AuthValidation $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            // Phân quyền sau login
            $user = Auth::user();

            //check xác thực
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                toastr()->error('Tài khoản chưa được xác nhận email. Vui lòng kiểm tra email để xác nhận.');
                return back()->withErrors(['message' => "Tài khoản chưa được xác nhận email"]);
            }

            $request->session()->regenerate();

            toastr()->success('Hello ' . $user->name);
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/');
            }
        } else {
            toastr()->error('Thông tin đăng nhập không chính xác');
            return back()->withErrors(['message' => "Thông tin đăng nhập không chính xác"]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('auth/login');
    }
}
