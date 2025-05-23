<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function get(Portfolio $portfolio)
    {
        return new SuccessResponse($portfolio);
    }

    public function all(Request $request)
    {
        return (new PaginResponse($data = Portfolio::pagin($request)))
            ->response()
            ->setStatusCode($data[0]->isEmpty() ? 404 : 200);
    }
}
