<?php

namespace App\Actions\OpenFood;

use Cerbero\JsonParser\JsonParser;
use Illuminate\Support\Facades\Storage;

class ExtractProductsDataFromFile
{
    public function execute(): array
    {
        $products = [];

        foreach (Storage::disk('openfoodfacts')->files() as $file) {
            $content = Storage::disk('openfoodfacts')->get($file);
            $content = str_replace('}', '},', $content);

            $jsonString = '[content]';
            $jsonString = str_replace('content', $content, $jsonString);

            $parser = JsonParser::parse($jsonString);

            foreach ($parser as $count => $item) {
                foreach ($item as $key => $value) {
                    $json[$key] = str_replace('"','',$value);
                }

                $products[] = $json;

                if ($count == env('AMOUNT_OF_PRODUCTS_TO_IMPORT')) {
                    break;
                }
            }
        }

        delete_trash_files();
        return $products;
    }
}
