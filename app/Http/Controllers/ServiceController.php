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

    public function all()
    {
        return new SuccessResponse([
            'coatings' => Service::where('type', 'coatings')->get(),
            'insulationOptions' => Service::where('type', 'insulationOptions')->get(),
        ]);
    }
}
