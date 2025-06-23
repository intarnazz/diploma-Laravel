<?php

namespace App\Models;

use App\Events\ChatMessageSent;
use App\Events\ChatStatusChange;
use App\Events\PrivateEve;
use App\Http\Requests\MassageRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Massage extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public static function add(MassageRequest $request)
    {
        $request = $request->validated();
        if (empty($request['chat_id'])) {
            $chat = Chat::add();
            $request['chat_id'] = $chat->id;
        }
        $request['user_id'] = Auth::id();
        $data = Massage::create($request);
        event(new ChatMessageSent($data));

        return $data;
    }

    public static function pagin(Request $request, $chat_id)
    {
        $chat = Chat::where('id', $chat_id)->first();
        $chat->update(['status' => 'Просмотрено']);
        $chat->save();
        event(new ChatStatusChange($chat));
        return [
            ($data = self::where('chat_id', $chat_id)
                ->orderBy('id')
                ->offset(
                    $request
                        ->header('offset') ?? 0
                )
                ->limit($request->header('limit') ?? 3)
                ->get()
            ),
            [
                ($limit = $request->header('limit') ?? 3),
                ($offset = $request->header('offset') ?? 0), self::count()
            ],
        ];
    }
}
