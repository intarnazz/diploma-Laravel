<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Inquiry extends Model
{
    protected $guarded = ['id'];

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
