<?php

namespace App\Actions\OpenFood;

use Illuminate\Support\Facades\Http;

class GetOpenFoodFactsFilesNames
{
    const PATTERN = '/products_\d{2}\.json\.gz/';

    public function execute(): array
    {
        $response = Http::acceptJson()->get(env('OPEN_FOOD_FACTS_LISTING_FILES_URL'));

        preg_match_all(self::PATTERN, $response, $files);

        return count($files) ? $files[0] : [];
    }
}
