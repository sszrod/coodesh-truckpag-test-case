<?php

namespace App\Actions;

use App\Enums\Status;
use App\Models\ProcessingLog;

class UpdateProcessingLog
{
    public function execute(string $id, Status $status): void
    {
        ProcessingLog::query()
            ->where('_id', $id)
            ->update([
                'status' => $status->value,
                'updated_at' => now()->toDayDateTimeString()
            ]);
    }
}
