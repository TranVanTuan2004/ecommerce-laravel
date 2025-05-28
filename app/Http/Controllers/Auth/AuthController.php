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
use Illuminate\Support\Facades\Storage;


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

            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with(['success' => 'Hello ' . $user->name]);
            } else {
                return redirect()->route('homePage')->with(['success' => 'Hello ' . $user->name]);
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
        return redirect()->route('homePage')->with(['success' => 'Đăng xuất thành công']);
    }

    //chức năng đăng ký
    public function showRegisterForm()
    {
        return view('client.pages.register.register');
    }

    public function register(Request $request)
    {
        $existing = User::where('email', $request->email)->first();
        if ($existing && !$existing->email_verified_at) {
            $existing->delete(); // Xóa bản ghi chưa xác minh
        }
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
        if ($tokenAge > 300) {
            return redirect()->route('register')->with('error', 'Token không hợp lệ hoặc đã hết hạn! Vui lòng đăng ký lại!');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_token_created_at' => null,

        ]);

        return redirect()->route('login')->with('success', 'Xác thực email thành công! Bạn có thể đăng nhập.');
    }


    public function showProfile()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        return view('client.pages.profile.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => [
                'required',
                'min:6',
                'max:14',
                'regex:/^\S*$/',
                'different:old_password'  // Mật khẩu mới phải khác mật khẩu cũ
            ],
        ], [
            'old_password.required' => 'Bạn phải nhập mật khẩu cũ.',
            'new_password.required' => 'Bạn phải nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.max' => 'Mật khẩu mới không được quá 14 ký tự.',
            'new_password.different' => 'Mật khẩu mới phải khác mật khẩu cũ.',
            'new_password.regex' => 'Mật khẩu không được chứa khoảng trắng.'
        ]);


        $user = Auth::user();

        // Kiểm tra xem mật khẩu cũ có đúng không
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.min' => 'Họ và tên phải có ít nhất :min ký tự.',
            'name.max' => 'Họ và tên không được vượt quá :max ký tự.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ (chỉ chấp nhận 10-15 chữ số).',
        ]);

        // Cập nhật thông tin người dùng
        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');

        Auth::user()->update($request->only('name', 'address', 'email', 'phone'));

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }


    //uploadAvatar
    public function uploadAvatar(Request $request)
    {
        $request->validate(
            [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif',
            ],
            [
                'avatar.required' => 'Vui lòng chọn ảnh.',
                'avatar.image' => 'Tập tin phải là hình ảnh.',
                'avatar.mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif.',
            ]
        );

        $user = Auth::user();

        // Xoá ảnh cũ nếu không phải mặc định
        if ($user->avatar && $user->avatar !== 'default.png') {
            $filename = basename($user->avatar);
            Storage::disk('public')->delete('avatars/' . $filename);
        }

        $file = $request->file('avatar');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('avatars', $filename, 'public');

        $user->avatar = 'storage/avatars/' . $filename;
        $user->save();

        return back()->with('success', 'Ảnh đại diện đã được cập nhật!');
    }
}
