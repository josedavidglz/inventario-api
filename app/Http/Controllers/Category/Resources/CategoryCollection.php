<?php

namespace App\Http\Controllers\Category\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->transform(function ($category) {
            return [
                'id'          => $category->id,
                'name'        => $category->name,
                'description' => $category->description,
            ];
        })->all();
    }
}
