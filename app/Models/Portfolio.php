<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = ['id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
