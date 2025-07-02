<?php

namespace App\Models;

use App\Events\ChatMessageSent;
use App\Events\ChatStatusChange;
use App\Events\NewChatCreate;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Message extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public static function add(MessageRequest $request)
    {
        $request = $request->validated();
        if (empty($request['chat_id'])) {
            $chat = Chat::add();
            $request['chat_id'] = $chat->id;
        }
        $request['user_id'] = Auth::id();
        $message = Message::create($request);
        $chat = Chat::find($message->chat_id);
        ViewedMessage::patch($chat);
        event(new NewChatCreate($chat, $chat->user_id));
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            event(new NewChatCreate($chat, $admin->id));
        }
        event(new ChatStatusChange($chat));
        event(new ChatMessageSent($message));
        return $message;
    }

    public static function pagin(Request $request, Chat $chat)
    {
        ViewedMessage::patch($chat);
        event(new ChatStatusChange($chat));
        return self::basePagination($request, where: ['chat_id' => $chat->id]);
    }
}
