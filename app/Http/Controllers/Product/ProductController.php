<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Listar',
            'data'    => [],
        ]);
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
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Mostrar',
            'data'    => ['id' => $id],
        ]);
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
