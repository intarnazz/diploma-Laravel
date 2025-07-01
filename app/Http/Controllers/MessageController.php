<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class MessageController extends Controller
{
    public function all(Request $request, Chat $chat)
    {
        return new PaginResponse(Message::pagin($request, $chat));
    }

    public function add(MessageRequest $request)
    {
        return new SuccessResponse(Message::add($request));
    }
}
