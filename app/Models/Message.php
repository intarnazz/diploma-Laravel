<?php

namespace App\Models;

use App\Events\ChatMessageSent;
use App\Events\ChatStatusChange;
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
        $data = Message::create($request);
        $chat = Chat::statusNew($request['chat_id']);
        event(new ChatStatusChange($chat));
        event(new ChatMessageSent($data));
        return $data;
    }

    public static function pagin(Request $request, $chat_id)
    {
        Chat::statusViewed($chat_id);
        return self::basePagination($request, where: ['chat_id' => $chat_id]);
    }
}
