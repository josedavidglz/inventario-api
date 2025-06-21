<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return response()->json('login');
    }

    public function register(Request $request)
    {
        return response()->json('register');
    }

    public function logout(Request $request)
    {
        return response()->json('logout');
    }
}
