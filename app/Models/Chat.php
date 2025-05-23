<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function pagin(Request $request)
    {
        $limit = $request->limit ?? 3;
        $offset = $request->offset ?? 0;

        $data = self::offset($offset)
            ->limit($limit)
            ->get();

        return [$data, [$limit, $offset, self::count()]];
    }
}
