<?php

namespace App\Models;

use App\Events\ChatMessageSent;
use App\Events\ChatStatusChange;
use App\Http\Requests\GuestQueryRequest;
use App\Http\Requests\MessageRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestQuery extends BaseModel
{
    public static function add(GuestQueryRequest $request)
    {
        return self::create($request->validated());
    }

    public static function pagin(Request $request)
    {
        return self::basePagination($request, orderByDesc: 'updated_at');
    }
}
