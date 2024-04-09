<?php

namespace App\Actions;


use Matriphe\Larinfo\LarinfoFacade as Larinfo;

class GetSystemInfo
{
    public function execute(): array
    {
        return Larinfo::getUptime();
    }
}
