<?php

namespace Actions;

use App\Actions\OpenFood\DownloadOpenFoodFiles;
use App\Actions\OpenFood\ExtractProductsDataFromFile;
use Tests\TestCase;

class ExtractOpenFoodProductsDataFromFileTest extends TestCase
{
    public function test_that_products_data_can_be_extracted_from_files(): void
    {
        app(DownloadOpenFoodFiles::class)->execute();

        $products = app(ExtractProductsDataFromFile::class)->execute();

        $product = $products[0];

        $this->assertIsArray($products);
        $this->assertArrayHasKey("code", $product);
        $this->assertArrayHasKey("url", $product);
        $this->assertArrayHasKey("created_t", $product);
        $this->assertArrayHasKey("creator", $product);
        $this->assertArrayHasKey("last_modified_t", $product);
        $this->assertArrayHasKey("product_name", $product);
        $this->assertArrayHasKey("quantity", $product);
        $this->assertArrayHasKey("brands", $product);
        $this->assertArrayHasKey("categories", $product);
        $this->assertArrayHasKey("labels", $product);
        $this->assertArrayHasKey("cities", $product);
        $this->assertArrayHasKey("purchase_places", $product);
        $this->assertArrayHasKey("stores", $product);
        $this->assertArrayHasKey("ingredients_text", $product);
        $this->assertArrayHasKey("traces", $product);
        $this->assertArrayHasKey("serving_size", $product);
        $this->assertArrayHasKey("serving_quantity", $product);
        $this->assertArrayHasKey("nutriscore_score", $product);
        $this->assertArrayHasKey("nutriscore_grade", $product);
        $this->assertArrayHasKey("main_category", $product);
        $this->assertArrayHasKey("image_url", $product);
    }
}
