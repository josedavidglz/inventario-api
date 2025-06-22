<?php

namespace App\Http\Controllers\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public static function handle($request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Credenciales inválidas.',
                'data'    => [],
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Login exitoso.',
            'data'    => [
                'token' => $token,
            ]
        ]);
    }
}
