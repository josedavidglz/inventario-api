<?php

namespace App\Http\Controllers\Category\Services;

use App\Http\Controllers\Category\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class ShowCategoryService
{
    public static function handle(int $id): JsonResponse
    {
        try {
            $product = Category::with('category')->find($id);

            if (!$product) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Categoria no encontrado.',
                ], 404);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Categoria obtenido correctamente.',
                'data'    => (new CategoryResource($product))->resolve(),
            ], 200);   

        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener la categoria.',
                'error'   => $ex->getMessage()
            ], 500);
        }
    }
}
