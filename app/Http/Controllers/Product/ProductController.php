<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Requests\CreateProductRequest;
use App\Http\Controllers\Product\Requests\UpdateProductRequest;
use App\Http\Controllers\Product\Services\CreateProductService;
use App\Http\Controllers\Product\Services\DeleteProductService;
use App\Http\Controllers\Product\Services\ListProductService;
use App\Http\Controllers\Product\Services\ShowProductService;
use App\Http\Controllers\Product\Services\UpdateProductService;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view products')->only('index');
        $this->middleware('permission:view product detail')->only('show');
        $this->middleware('permission:create products')->only('store');
        $this->middleware('permission:update products')->only('update');
        $this->middleware('permission:delete products')->only('destroy');
    }

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

    public function update(UpdateProductRequest $request, $id)
    {
        return UpdateProductService::handle($id, $request);
    }

    public function destroy($id)
    {
        return DeleteProductService::handle($id);
    }
}
