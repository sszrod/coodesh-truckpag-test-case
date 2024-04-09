<?php

namespace App\Actions;

use App\Models\Product;

class GetAllProducts
{
    public function execute()
    {
        return Product::paginate(10);
    }
}
