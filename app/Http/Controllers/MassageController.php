<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassageRequest;
use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Chat;
use App\Models\Massage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class MassageController extends Controller
{
    public function all(Request $request, $chat_id)
    {
        return (new PaginResponse($data = Massage::pagin($request, $chat_id)))
            ->response()
            ->setStatusCode($data[0]->isEmpty() ? 404 : 200);
    }

    public function add(MassageRequest $request)
    {
        return new SuccessResponse(Massage::add($request));
    }
}
