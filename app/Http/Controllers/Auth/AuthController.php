<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Services\LoginService;
use App\Http\Controllers\Auth\Services\LogoutService;
use App\Http\Controllers\Auth\Services\RegisterService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return LoginService::handle($request);
    }

    public function register(Request $request)
    {
        return RegisterService::handle($request);
    }

    public function logout(Request $request)
    {
        return LogoutService::handle($request);
    }
}
