<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


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
            $request->session()->regenerate();
            // Phân quyền sau login
            $user = Auth::user();
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

    //Register
    public function showRegisterForm()
    {
        return view('client.pages.register.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }

    //ChangePassword
    public function showChangePasswordForm()
    {
        return view('client.pages.change_password.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'new_password_confirmation' => 'required|same:new_password',

            ],
            [
                'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'new_password.required' => 'Mật khẩu mới không được để trống.',
                'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 kí tự.',
                'new_password_confirmation.required' => 'Vui lòng nhập lại mật khẩu mới.',
                'new_password_confirmation.same' => 'Mật khẩu nhập lại không khớp.'
            ]
        );

        if ($request->current_password === $request->new_password) {
            return back()->withErrors(['new_password' => 'Mật khẩu mới không được giống mật khẩu hiện tại.']);
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();



        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật thành công! Vui lòng đăng nhập lại.');
    }



    //ForgotPassword
    public function showForgotPasswordForm()
    {
        return view('client.pages.forgot_password.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.exists' => 'Email không tồn tại.'
            ]
        );

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            toastr()->success('Liên kết đặt lại mật khẩu được liên kết đến email của bạn');
            return back();
        }
        toastr()->error('Không thể gửi lại email đặt lại mật khẩu');
        return back()->withErrors(['email' => ($status)]);
    }

    //ResetPassword
    public function showResetPasswordForm($token)
    {
        return view('client.pages.reset_password.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6|confirmed',
                'token' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không hợp lệ.',
                'email.exists' => 'Email này chưa được đăng ký trong hệ thống.',
                'password.required' => 'Vui lòng nhập nhập khẩu.',
                'password.min' => 'Password phải có ít nhất 6 kí tự.',
                'password.confirmed' => 'Password xác nhận không hợp lệ.',
                'token.required' => 'Mã token không hợp lệ hoặc đã hết hạn.'

            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            toastr()->success('Mật khẩu đã được cập nhật thành công! Vui lòng đăng nhập lại.');
            return redirect()->route('login');
        }
        toastr()->error('Thay đổi mật khẩu không thành công.');
        return back()->withError(['email' => ($status)]);
    }
}
