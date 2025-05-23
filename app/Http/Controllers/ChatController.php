<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function get(Chat $chat)
    {
        return new SuccessResponse($chat);
    }

    public function all(Request $request)
    {
        return (new PaginResponse($data = Chat::pagin($request)))
            ->response()
            ->setStatusCode($data[0]->isEmpty() ? 404 : 200);
    }
}
