<?php

namespace App\Http\Controllers\Auth\Services;

class LogoutService
{
    public static function handle($request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Sesión cerrada exitosamente.',
            'data'    => [],
        ]);
    }
}
