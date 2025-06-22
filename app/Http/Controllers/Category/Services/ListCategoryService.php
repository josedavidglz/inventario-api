<?php

namespace App\Http\Controllers\Category\Services;

use App\Http\Controllers\Category\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class ListCategoryService
{
    public static function handle(): JsonResponse
    {
        try {
            $category = Category::paginate(10);

            return response()->json([
                'status'          => 'success',
                'message'         => 'Lista categorias',
                'first_page_url'  => $category->url(1),
                'last_page_url'   => $category->url($category->lastPage()),
                'prev_page_url'   => $category->previousPageUrl(),
                'next_page_url'   => $category->nextPageUrl(),
                'current_page'    => $category->currentPage(),
                'last_page'       => $category->lastPage(),
                'total'           => $category->total(),
                'per_page'        => $category->perPage(),
                'data'            => (new CategoryCollection($category))->resolve()
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No se pudo cargar las categorias.',
                'error'   => $ex->getMessage()
            ], 500);
        }
    }
}
