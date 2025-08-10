<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\NameToKeyResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Contact;

class ContactController extends Controller
{
    public function all()
    {
        return new SuccessResponse(new NameToKeyResponse(Contact::all()));
    }

    public function patch(ContactRequest $request)
    {
        return new SuccessResponse(Contact::patch($request));
    }
}
