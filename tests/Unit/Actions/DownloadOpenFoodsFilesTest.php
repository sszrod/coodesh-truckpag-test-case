<?php

namespace Actions;

use App\Actions\OpenFood\DownloadOpenFoodFiles;
use App\Actions\OpenFood\GetOpenFoodFactsFilesNames;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Tests\TestCase;

class DownloadOpenFoodsFilesTest extends TestCase
{
    public function test_that_process_download_files(): void
    {
        delete_trash_files();

        app(DownloadOpenFoodFiles::class)->execute();

        $files = Storage::disk('openfoodfacts')->files();

        $list = [
            'products_01.json',
            'products_02.json',
            'products_03.json',
            'products_04.json',
            'products_05.json',
            'products_06.json',
            'products_07.json',
            'products_08.json',
            'products_09.json',
        ];

        $this->assertTrue(count($files) === 9);
        $this->assertEquals($files, $list);

        delete_trash_files();
    }
}
