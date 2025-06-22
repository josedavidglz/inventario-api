<?php

namespace App\Http\Controllers\Product\Services;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ListProductService
{
    public static function handle(): JsonResponse
    {
        try {
            $contacts = Product::paginate(10);

            return response()->json([
                'status'          => 'success',
                'message'         => 'Lista productos',
                'first_page_url'  => $contacts->url(1),
                'last_page_url'   => $contacts->url($contacts->lastPage()),
                'prev_page_url'   => $contacts->previousPageUrl(),
                'next_page_url'   => $contacts->nextPageUrl(),
                'current_page'    => $contacts->currentPage(),
                'last_page'       => $contacts->lastPage(),
                'total'           => $contacts->total(),
                'per_page'        => $contacts->perPage(),
                'data'            => $contacts
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No se pudo cargar los contactos.',
                'error'   => $ex->getMessage()
            ], 500);
        }
    }
}
