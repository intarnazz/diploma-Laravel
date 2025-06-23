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

    public static function add()
    {
        return Chat::create(['user_id' => Auth::id()]);
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
