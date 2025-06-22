<?php

namespace App\Http\Controllers\Product\Services;

use App\Http\Controllers\Product\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateProductService
{
    public static function handle(int $id, $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Producto no encontrado.',
                ], 404);
            }

            $product->update([
                'category_id' => $data['category_id'],
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Producto actualizado correctamente.',
                'data'    => (new ProductResource($product->fresh()))->resolve(),
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al actualizar el producto.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
