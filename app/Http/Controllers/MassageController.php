<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginResponse;
use App\Models\Massage;
use Illuminate\Http\Request;

class MassageController extends Controller
{
    public function all(Request $request, $chat_id)
    {
        return (new PaginResponse($data = Massage::pagin($request, $chat_id)))
            ->response()
            ->setStatusCode($data[0]->isEmpty() ? 404 : 200);
    }
}
