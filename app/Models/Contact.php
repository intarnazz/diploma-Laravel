<?php

namespace App\Models;

use App\Http\Requests\ContactRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function patch(ContactRequest $request)
    {
        return self::update($request->validated());
    }
}
