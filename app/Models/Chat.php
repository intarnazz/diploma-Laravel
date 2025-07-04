<?php

namespace App\Models;

use App\Events\ChatStatusChange;
use App\Events\NewChatCreate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends BaseModel
{
    protected $with = ['user', 'latestMessage'];
    protected $appends = ['viewedMessage'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function viewedMessage()
    {
        return $this->hasOne(ViewedMessage::class, 'chat_id', 'id')
            ->where('user_id', auth()->id());
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest('id');
    }

    public static function add()
    {
        $chat = self::create(['user_id' => Auth::id()]);
        event(new NewChatCreate($chat, auth()->id()));
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            event(new NewChatCreate($chat, $admin->id));
        }
        return $chat;
    }

    public static function pagin(Request $request)
    {
        $user = Auth::user();
        return self::basePagination($request, where: ['user_id' => $user->id], orderByDesc: 'updated_at');
    }

    public function getViewedMessageAttribute()
    {
        return $this->viewedMessage()->firstOrCreate(
            ['user_id' => auth()->id()],
            ['chat_id' => $this->id]
        );
    }
}
