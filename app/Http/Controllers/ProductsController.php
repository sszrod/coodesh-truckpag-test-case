<?php

namespace App\Http\Controllers;

use App\Actions\GetAllProducts;
use App\Actions\GetProductByCode;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    public function getAll()
    {
        return ProductResource::collection(app(GetAllProducts::class)->execute());
    }

    public function getByCode(string $code)
    {
        return ProductResource::make(app(GetProductByCode::class)->execute($code));
    }

    public function updateByCode(UpdateProductRequest $request, string $code): ProductResource
    {
        return ProductResource::make(app(GetProductByCode::class)->execute($code));
    }

    public function deleteByCode(string $code)
    {
        return ProductResource::make(app(GetProductByCode::class)->execute($code));
    }
}
