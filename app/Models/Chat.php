<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user', 'latestMassage'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function massage()
    {
        return $this->hasMany(Massage::class);
    }

    public function latestMassage()
    {
        return $this->hasOne(Massage::class)->latest('id');
    }
    protected static function getStatus($chat_id, $status)
    {
        $chat = self::where('id', $chat_id)->first();
        $chat->update(['status' => $status]);
        $chat->save();
        return $chat;
    }
    public static function statusViewed($chat_id)
    {
        return self::getStatus($chat_id, 'viewed');
    }
    public static function statusNew($chat_id)
    {
        return self::getStatus($chat_id, 'new');
    }

    public static function add()
    {
        return self::create(['user_id' => Auth::id()]);
    }

    public static function pagin(Request $request)
    {
        $user = Auth::user();
        $q = $user->role === 'admin'
            ? self::query()
            : self::where('user_id', $user->id);

        $q = $q->orderByDesc('created_at')
            ->limit($limit = $request->header('limit', 20))
            ->offset($offset = $request->header('offset', 0));

        return [
            $q->get(),
            [$limit, $offset, (clone $q)->count()]
        ];
    }

}
