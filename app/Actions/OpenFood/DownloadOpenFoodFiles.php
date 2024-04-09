<?php

namespace App\Actions\OpenFood;

use Illuminate\Support\Facades\Storage;

class DownloadOpenFoodFiles
{
    public function __construct(private GetOpenFoodFactsFilesNames $getFileNames)
    {
    }

    public function execute(): void
    {
        foreach ($this->getFileNames->execute() as $file) {
            Storage::disk('openfoodfacts')->put($file, file_get_contents(env('OPEN_FOOD_FACTS_DOWNLOAD_FILE_URL') . $file));
        }

        uncompress_gzip_file(public_path('openfoodsfacts/'), Storage::disk('openfoodfacts')->files());
    }
}
