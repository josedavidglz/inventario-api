<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Requests\CreateProductRequest;
use App\Http\Controllers\Product\Services\CreateProductService;
use App\Http\Controllers\Product\Services\ListProductService;
use App\Http\Controllers\Product\Services\ShowProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return ListProductService::handle();
    }

    public function store(CreateProductRequest $request)
    {
        return CreateProductService::handle($request);
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
