<?php

namespace App\Filament\Resources\NewsUpdates\Pages;

use App\Filament\Resources\NewsUpdates\NewsUpdateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsUpdate extends CreateRecord
{
    protected static string $resource = NewsUpdateResource::class;
}
