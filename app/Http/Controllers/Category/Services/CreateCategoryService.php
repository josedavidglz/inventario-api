<?php

namespace App\Http\Controllers\Category\Services;

use App\Http\Controllers\Category\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateCategoryService
{
    public static function handle($data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product = Category::create([
                'name'        => $data['name'],
                'description' => $data['description'],
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Categoria creado correctamente.',
                'data'    => (new CategoryResource($product))->resolve(),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al crear la categoria.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
