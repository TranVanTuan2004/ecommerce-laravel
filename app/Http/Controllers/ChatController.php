<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'content' => $request->input('message'),
        ]);

        broadcast(new MessageSent($message->content, auth()->user()))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
