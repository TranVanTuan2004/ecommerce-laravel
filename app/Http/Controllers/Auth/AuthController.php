<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;


use function Flasher\Toastr\Prime\toastr;

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
        return redirect()->route('homePage');
    }

    //chức năng đăng ký
    public function showRegisterForm()
    {
        return view('client.pages.register.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'name.required' => 'Hãy cho chúng tôi biết tên của bạn.',
            'name.min' => 'Tên của bạn phải có ít nhất 3 ký tự.',
            'email.required' => 'Bạn cần nhập email để tiếp tục.',
            'email.email' => 'Định dạng email chưa đúng. Hãy thử lại.',
            'email.unique' => 'Email này đã được đăng ký. Hãy thử email khác.',
            'password.required' => 'Bạn cần nhập mật khẩu.',
            'password.min' => 'Mật khẩu quá ngắn. Ít nhất 6 ký tự.',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu.',
            'password.confirmed' => 'Mật khẩu không trùng khớp. Hãy kiểm tra lại.',
        ]);



        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $verificationToken = sha1(time());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $verificationToken,
            'email_verification_token_created_at' => now(), // Lưu thời gian tạo token
        ]);

        // Gửi email xác thực
        Mail::to($user->email)->send(new VerifyEmail($user));

        return redirect()->route('register')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('register')->with('error', 'Token không hợp lệ hoặc đã hết hạn! Vui lòng đăng ký lại!');
        }

        $tokenAge = now()->diffInSeconds($user->email_verification_token_created_at);
        if ($tokenAge > 60) {
            return redirect()->route('register')->with('error', 'Token không hợp lệ hoặc đã hết hạn! Vui lòng đăng ký lại!');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_token_created_at' => null,

        ]);

        return redirect()->route('login')->with('success', 'Xác thực email thành công! Bạn có thể đăng nhập.');
    }
}
