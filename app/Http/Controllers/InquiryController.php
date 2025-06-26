<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function get(Inquiry $inquiry)
    {
        return new SuccessResponse($inquiry);
    }

    public function all(Request $request)
    {
        return new PaginResponse(Inquiry::pagin($request));
    }
}
