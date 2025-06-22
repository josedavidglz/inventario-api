<?php

namespace App\Http\Controllers\Product\Services;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeleteProductService
{
    public static function handle(int $id): JsonResponse
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

            $product->delete();

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Producto eliminado correctamente.',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al eliminar el producto.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
