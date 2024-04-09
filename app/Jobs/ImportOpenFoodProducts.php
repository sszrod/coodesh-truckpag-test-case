<?php

namespace App\Jobs;

use App\Actions\OpenFood\DownloadOpenFoodFiles;
use App\Actions\OpenFood\ImportOpenFoodProductsData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportOpenFoodProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(DownloadOpenFoodFiles::class)->execute();

        $files = Storage::disk('openfoodfacts')->files();

        if (count($files)) {
            app(ImportOpenFoodProductsData::class)->execute();
        }
    }
}
