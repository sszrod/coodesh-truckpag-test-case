<?php

namespace App\Actions;

use App\Enums\Status;
use App\Models\ProcessingLog;

class CreateProcessingLog
{
    public function execute(): ProcessingLog
    {
        return ProcessingLog::create([
            'status' => Status::DRAFT->value,
            'create_at' => now()->toDayDateTimeString()
        ]);
    }
}
