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

    public static function pagin(Request $request)
    {
        $limit = $request->header('limit') ?? 3;
        $offset = $request->header('offset') ?? 0;
        $data = self::where('user_id', Auth::id())
            ->offset($offset)
            ->limit($limit)
            ->get();
        return [$data, [$limit, $offset, self::count()]];
    }
}
