<?php

namespace App\Actions;

use App\Enums\Status;
use App\Models\Product;

class DeleteProductByCode
{
    public function execute(string $code)
    {
        Product::query()->where('code', '=', $code)->update(['status' => Status::TRASH->value]);
        return Product::query()->where('code', '=', $code)->firstOrFail();
    }
}
