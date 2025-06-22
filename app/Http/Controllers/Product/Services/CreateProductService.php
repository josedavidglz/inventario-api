<?php

namespace App\Http\Controllers\Product\Services;

use App\Http\Controllers\Product\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateProductService
{
    public static function handle($data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'category_id' => $data['category_id'],
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Producto creado correctamente.',
                'data'    => (new ProductResource($product))->resolve(),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al crear el producto.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
