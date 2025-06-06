<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Portfolio extends Model
{
    protected $guarded = ['id'];
    protected $with = ['image'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public static function pagin(Request $request)
    {
        $limit = $request->header('limit') ?? 4;
        $offset = $request->header('offset') ?? 0;

        $data = self::offset($offset)
            ->limit($limit)
            ->get();

        return [$data, [$limit, $offset, self::count()]];
    }
}
