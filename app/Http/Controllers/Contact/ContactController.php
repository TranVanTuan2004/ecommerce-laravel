<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;  // nhớ import model Contact

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function index()
    {
        return view('client.pages.contact.contact');
    }

    // Xử lý dữ liệu gửi từ form liên hệ
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Lưu dữ liệu vào database
        Contact::create($validated);

        // Redirect về trang liên hệ với thông báo thành công
        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
    }
}
