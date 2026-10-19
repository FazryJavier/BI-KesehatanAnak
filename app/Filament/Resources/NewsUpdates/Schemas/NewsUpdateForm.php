<?php

namespace App\Filament\Resources\NewsUpdates\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class NewsUpdateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->rows(8)
                    ->columnSpanFull(),
            ]);
    }
}
