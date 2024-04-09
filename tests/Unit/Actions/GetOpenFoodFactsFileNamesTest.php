<?php

namespace Actions;

use App\Actions\OpenFood\GetOpenFoodFactsFilesNames;
use Tests\TestCase;

class GetOpenFoodFactsFileNamesTest extends TestCase
{
    public function test_that_return_is_an_array_of_string(): void
    {
        $list = [
            'products_01.json.gz',
            'products_02.json.gz',
            'products_03.json.gz',
            'products_04.json.gz',
            'products_05.json.gz',
            'products_06.json.gz',
            'products_07.json.gz',
            'products_08.json.gz',
            'products_09.json.gz',
        ];

        $fileNames = app(GetOpenFoodFactsFilesNames::class)->execute();

        $this->assertIsArray($fileNames);
        $this->assertEquals($list, $fileNames);
        $this->assertTrue(count($fileNames) === count($list));
    }
}
