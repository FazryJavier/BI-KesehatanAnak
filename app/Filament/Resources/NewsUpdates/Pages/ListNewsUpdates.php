<?php

namespace App\Filament\Resources\NewsUpdates\Pages;

use App\Filament\Resources\NewsUpdates\NewsUpdateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNewsUpdates extends ListRecords
{
    protected static string $resource = NewsUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
