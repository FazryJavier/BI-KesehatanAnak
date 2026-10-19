<?php

namespace App\Filament\Resources\NewsUpdates\Pages;

use App\Filament\Resources\NewsUpdates\NewsUpdateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsUpdate extends CreateRecord
{
    protected static string $resource = NewsUpdateResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author_id'] = auth()->id();

        return $data;
    }
}
