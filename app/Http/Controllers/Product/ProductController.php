<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Services\ListProductService;
use App\Http\Controllers\Product\Services\ShowProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return ListProductService::handle();
    }

    public function store(Request $request)
    {
        return response()->json([
            'status'  => 'success',
            'code'    => 201,
            'message' => 'Crear',
            'data'    => [],
        ]);
    }

    public function show($id)
    {
        return ShowProductService::handle($id);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Actualizar',
            'data'    => ['id' => $id],
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Eliminar',
            'data'    => ['id' => $id],
        ]);
    }
}
