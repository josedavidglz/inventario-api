<?php

namespace App\Http\Controllers\Category\Services;

use App\Models\category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeleteCategoryService
{
    public static function handle(int $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'categoria no encontrada.',
                ], 404);
            }

            $category->delete();

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'categoria eliminada correctamente.',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Error al eliminar la categoria.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
