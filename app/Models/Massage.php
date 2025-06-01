<?php

namespace App\Models;

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
        return $data;
    }

    public static function pagin(Request $request, $chat_id)
    {
        $limit = $request->limit ?? 3;
        $offset = $request->offset ?? 0;

        $data = self::where('chat_id', $chat_id)
            ->orderByDesc('id')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return [$data, [$limit, $offset, self::count()]];
    }
}
