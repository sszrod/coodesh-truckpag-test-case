<?php

namespace App\Actions\OpenFood;

use App\Actions\CreateProcessingLog;
use App\Actions\UpdateProcessingLog;
use App\Enums\Status;
use App\Models\Product;

class ImportOpenFoodProductsData
{
    public function __construct(private ExtractProductsDataFromFile $extractorAction)
    {
    }

    public function execute(): void
    {
        $log = app(CreateProcessingLog::class)->execute();

        $productsData = $this->extractorAction->execute();

        foreach ($productsData as $product) {
            $product['imported_t'] = now()->timestamp;
            $product['status'] = Status::PUBLISHED->value;

            Product::updateOrCreate(
                ['code' => $product['code']],
                $product
            );
        }

        app(UpdateProcessingLog::class)->execute($log->_id, Status::PUBLISHED);
    }
}
