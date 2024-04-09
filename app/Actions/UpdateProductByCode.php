<?php

namespace App\Actions;

use App\Enums\Status;
use App\Models\Product;

class UpdateProductByCode
{
    public function execute(string $code, array $data): Product
    {
        $data['status'] = Status::DRAFT->value;

        Product::where('code','=', $code)->update($data);

        return Product::where('code', '=', $code)->firstOrFail();
    }
}
