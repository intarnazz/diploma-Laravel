<?php

namespace App\Http\Controllers;

use App\Events\PrivateEve;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function reg(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->api_token = (string)Str::uuid();
        $user->save();

        return response([
            "success" => true,
            "message" => "Успешно",
            "token" => $user->api_token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = auth()->attempt($request->validated());
        if (!$user) {
            return response([
                "success" => false,
                "message" => "Неверный логин или пароль",
            ], 422);
        }

        $user = auth()->user();
        $user->api_token = (string)Str::uuid();
        $user->save();

        return response([
            "success" => true,
            "message" => "Успешно",
            "token" => $user->api_token
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return response([
            "success" => true,
            "message" => "Успешно",
            "data" => $user
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = '';
        $user->save();

        return response([
            "success" => true,
            "message" => "Logout",
        ]);
    }
}
