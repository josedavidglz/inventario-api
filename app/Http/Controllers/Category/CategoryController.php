<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Category\Requests\CreateCategoryRequest;
use App\Http\Controllers\Category\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Category\Services\CreateCategoryService;
use App\Http\Controllers\Category\Services\DeleteCategoryService;
use App\Http\Controllers\Category\Services\ListCategoryService;
use App\Http\Controllers\Category\Services\ShowCategoryService;
use App\Http\Controllers\Category\Services\UpdateCategoryService;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view categories')->only('index');
        $this->middleware('permission:view categories')->only('show');
        $this->middleware('permission:create categories')->only('store');
        $this->middleware('permission:update categories')->only('update');
        $this->middleware('permission:delete categories')->only('destroy');
    }

    public function index()
    {
        return ListCategoryService::handle();
    }

    public function store(CreateCategoryRequest $request)
    {
        return CreateCategoryService::handle($request);
    }

    public function show($id)
    {
        return ShowCategoryService::handle($id);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return UpdateCategoryService::handle($id, $request);
    }

    public function destroy($id)
    {
        return DeleteCategoryService::handle($id);
    }
}
