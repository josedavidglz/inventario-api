<?php

namespace App\Http\Controllers\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{
    public static function handle($request)
    {
        DB::beginTransaction();

        try {
            $user = self::user($request);
            $user->save();

            $user->assignRole($request->role ?? 'user');

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'code'    => 201,
                'message' => 'Usuario registrado exitosamente.',
                'data'    => [
                    'token' => $user->createToken('api-token')->plainTextToken,
                ]
            ], 201);

        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Error al registrar usuario.',
                'data'    => ['error' => $ex->getMessage()],
            ], 500);
        }
    }

    public static function user($request)
    {
        $user = new User;
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->password       = Hash::make($request->password);
        $user->remember_token = Str::random(25);

        return $user;
    }

}
