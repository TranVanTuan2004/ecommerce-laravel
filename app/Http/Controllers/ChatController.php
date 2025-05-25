<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }


        $user = Auth::user();

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('message'),
        ]);

        broadcast(new \App\Events\MessageSent($message->content, $user))->toOthers();

        return response()->json(['status' => 'Message Sent']);
    }
}
