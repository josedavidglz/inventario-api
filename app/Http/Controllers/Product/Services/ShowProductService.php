<?php

namespace App\Http\Controllers\Product\Services;

use App\Http\Controllers\Product\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ShowProductService
{
    public static function handle(int $id): JsonResponse
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Producto no encontrado.',
                ], 404);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Producto obtenido correctamente.',
                'data'    => (new ProductResource($product))->resolve(),
            ], 200);   

        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener el producto.',
                'error'   => $ex->getMessage()
            ], 500);
        }
    }
}
