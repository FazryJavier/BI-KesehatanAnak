<?php

namespace App\Filament\Resources\LookerStudios\Pages;

use App\Filament\Resources\LookerStudios\LookerStudioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLookerStudios extends ListRecords
{
    protected static string $resource = LookerStudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
