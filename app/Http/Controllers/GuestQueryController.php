<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestQueryRequest;
use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\GuestQuery;
use Illuminate\Http\Request;

class GuestQueryController extends Controller
{
    public function get(GuestQuery $guestQuery)
    {
        return new SuccessResponse($guestQuery);
    }

    public function add(GuestQueryRequest $request)
    {
        return new SuccessResponse(GuestQuery::add($request));
    }

    public function all(Request $request)
    {
        return new PaginResponse(GuestQuery::pagin($request));
    }
}
