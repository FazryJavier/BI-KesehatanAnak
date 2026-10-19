<?php

namespace App\Filament\Resources\LookerStudios\Pages;

use App\Filament\Resources\LookerStudios\LookerStudioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLookerStudio extends EditRecord
{
    protected static string $resource = LookerStudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
