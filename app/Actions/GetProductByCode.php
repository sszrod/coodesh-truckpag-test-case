<?php

namespace App\Actions;

use App\Models\Product;

class GetProductByCode
{
    public function execute(string $code): Product
    {
        return Product::where('code','=', $code)->firstOrFail();
    }
}
