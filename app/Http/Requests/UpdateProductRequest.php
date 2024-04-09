<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "brands" => "nullable|string",
            "categories" => "nullable|string",
            "cities" => "nullable|string",
            "created_t" => "nullable|string",
            "creator" => "nullable|string",
            "image_url" => "nullable|string|url",
            "imported_t" => "nullable|int",
            "ingredients_text" => "nullable|string",
            "labels"=> "nullable|string",
            "last_modified_t" => "nullable|string",
            "main_category" => "nullable|string",
            "nutriscore_grade" => "nullable|string",
            "nutriscore_score" => "nullable|string",
            "product_name" => "nullable|string",
            "purchase_places" => "nullable|string",
            "quantity" => "nullable|string",
            "serving_quantity" => "nullable|string",
            "serving_size" => "nullable|string",
            "stores" => "nullable|string",
            "traces" => "nullable|string",
            "url" => "nullable|string|url",
        ];
    }
}
