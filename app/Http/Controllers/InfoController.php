<?php

namespace App\Http\Controllers;

use App\Actions\GetSystemInfo;

class InfoController extends Controller
{
    public function __invoke()
    {
        return response()->json(
            app(GetSystemInfo::class)->execute(),
            200
        );
    }
}
