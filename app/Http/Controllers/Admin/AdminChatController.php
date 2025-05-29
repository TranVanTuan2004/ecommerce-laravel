<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminChatController extends Controller
{
    // Trang admin chat: danh sách user đang chat
    public function adminView()
    {
        return view('admin.pages.chat.admin');
    }

    // Lấy danh sách user có tin nhắn (chatting)
    public function getUsersChatting()
    {
        $userIds = Message::select('user_id')->distinct()->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return response()->json($users);
    }

    // Lấy tin nhắn của user cụ thể
    public function getMessagesByUser($userId)
    {
        $messages = Message::where('user_id', $userId)->orderBy('created_at')->get();

        return response()->json($messages);
    }

    // Gửi tin nhắn admin đến user
    public function sendAdminMessageToUser(Request $request, $userId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'user_id' => $userId,
            'content' => $request->content,
            'sender' => 'admin',
        ]);

        // Có thể broadcast event realtime

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessageStatistics() //hàm thống kê new messages
    {
        // Tổng số tin nhắn
        $totalMessages = Message::count();

        // Tin nhắn gần đây (ví dụ: 5 tin mới nhất)
        $recentMessages = Message::latest()->limit(5)->get();

        // Số lượng tin nhắn theo user (tuỳ chọn)
        $messagePerUser = Message::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('user_id, COUNT(*) as total')
            ->get();

        return view('admin.pages.dashboard.dashboard', compact('totalMessages', 'recentMessages', 'messagePerUser'));
    }
}
