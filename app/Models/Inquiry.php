<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Inquiry extends BaseModel
{
    public static function pagin(Request $request)
    {
        return self::basePagination($request);
    }
}
