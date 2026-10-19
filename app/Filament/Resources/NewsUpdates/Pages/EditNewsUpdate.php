<?php

namespace App\Filament\Resources\NewsUpdates\Pages;

use App\Filament\Resources\NewsUpdates\NewsUpdateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNewsUpdate extends EditRecord
{
    protected static string $resource = NewsUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
