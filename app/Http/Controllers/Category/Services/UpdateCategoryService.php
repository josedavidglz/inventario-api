<?php

namespace App\Http\Controllers\Category\Services;

use App\Http\Controllers\Category\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateCategoryService
{
    public static function handle(int $id, $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product = Category::find($id);

            if (!$product) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Categoria no encontrado.',
                ], 404);
            }

            $product->update([
                'name'        => $data['name'],
                'description' => $data['description'],
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Categoria actualizada correctamente.',
                'data'    => (new CategoryResource($product->fresh()))->resolve(),
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al actualizar la categoria.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
