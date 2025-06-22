<?php

namespace App\Http\Controllers\Product\Services;

use App\Http\Controllers\Product\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ListProductService
{
    public static function handle(): JsonResponse
    {
        try {
            $products = Product::paginate(10);

            return response()->json([
                'status'          => 'success',
                'message'         => 'Lista productos',
                'first_page_url'  => $products->url(1),
                'last_page_url'   => $products->url($products->lastPage()),
                'prev_page_url'   => $products->previousPageUrl(),
                'next_page_url'   => $products->nextPageUrl(),
                'current_page'    => $products->currentPage(),
                'last_page'       => $products->lastPage(),
                'total'           => $products->total(),
                'per_page'        => $products->perPage(),
                'data'            => (new ProductCollection($products))->resolve()
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No se pudo cargar los productos.',
                'error'   => $ex->getMessage()
            ], 500);
        }
    }
}
