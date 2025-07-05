<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Portfolio extends BaseModel
{
    protected $with = ['image'];

    public function getGlobalSearchResultTitle(): string
    {
        return $this->title;
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public static function pagin(Request $request)
    {
        return self::basePagination($request);
    }
}
