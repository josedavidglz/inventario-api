<?php

namespace App\Http\Controllers\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform a single product into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'category'    => [
                'id'   => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
        ];
    }
}
