<?php

namespace App\Console\Commands;

use App\Jobs\ImportOpenFoodProducts;
use Illuminate\Console\Command;

class UpdateOpenFoodFactsProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-open-food-facts-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch Job for import and update products from OpenFoodFacts file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ImportOpenFoodProducts::dispatch();
    }
}
