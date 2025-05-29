<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message; // Model lưu tin nhắn, bạn cần tạo model và migration
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent; // Sự kiện phát realtime, mình sẽ hướng dẫn tạo ở phần sau

class ClientChatController extends Controller
{
    public function index()
    {
        // Lấy tất cả tin nhắn của user đang đăng nhập (client)
        $messages = Message::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('client.components.chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Chưa đăng nhập'], 401);
        }

        $content = $request->input('content');

        // Lưu tin nhắn với sender = 'user'
        $message = Message::create([
            'user_id' => $user->id,
            'content' => $content,
            'sender' => 'user',
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessages()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Chưa đăng nhập'], 401);
        }

        // Lấy tất cả tin nhắn của user này
        $messages = Message::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($user) {
                // Nếu sender trong DB là 'user' thì giữ nguyên, còn không thì 'admin'

                $sender = $message->sender; // ví dụ: 'user' hoặc 'admin'

                // Đảm bảo chỉ có 2 giá trị này
                if ($sender !== 'user' && $sender !== 'admin') {
                    $sender = 'admin';
                }

                return [
                    'id' => $message->id,
                    'content' => $message->content,
                    'sender' => $sender,
                    'created_at' => $message->created_at->toDateTimeString(),
                ];
            });

        return response()->json($messages);
    }
}
