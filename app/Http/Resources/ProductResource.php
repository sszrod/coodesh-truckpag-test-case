<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "_id" => $this->_id,
            "code" => $this->brands,
            "brands" => $this->categories,
            "categories" => $this->categories,
            "cities" => $this->cities,
            "created_t" => $this->created_t,
            "creator" => $this->creator,
            "image_url" => $this->image_url,
            "imported_t" => $this->imported_t,
            "ingredients_text" => $this->ingredients_text,
            "labels" => $this->labels,
            "last_modified_t" => $this->last_modified_t,
            "main_category" => $this->main_category,
            "nutriscore_grade" => $this->nutriscore_grade,
            "nutriscore_score" => $this->nutriscore_score,
            "product_name" => $this->product_name,
            "purchase_places" => $this->purchase_places,
            "quantity" => $this->quantity,
            "serving_quantity" => $this->serving_quantity,
            "serving_size" => $this->serving_size,
            "status" => $this->status,
            "stores" => $this->stores,
            "traces" => $this->traces,
            "url" => $this->url,
            "updated_at" => $this->updated_at
        ];
    }
}
