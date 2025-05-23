<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function get(Service $service)
    {
        return new SuccessResponse($service);
    }

    public function all(Request $request)
    {
        return (new PaginResponse($data = Service::pagin($request)))
            ->response()
            ->setStatusCode($data[0]->isEmpty() ? 404 : 200);
    }
}
