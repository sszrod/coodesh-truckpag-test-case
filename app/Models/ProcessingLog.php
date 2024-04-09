<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProcessingLog extends Model
{
    protected $table = 'processing_logs';
    protected $guarded= ['_id'];
}
