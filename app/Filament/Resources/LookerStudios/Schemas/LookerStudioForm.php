<?php

namespace App\Filament\Resources\LookerStudios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LookerStudioForm
{
    public const EMBED_PREFIX = 'https://lookerstudio.google.com/';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->label('Embed URL')
                    ->url()
                    ->startsWith(self::EMBED_PREFIX)
                    ->maxLength(2048)
                    ->required()
                    ->helperText('Looker Studio embed link, starting with '.self::EMBED_PREFIX)
                    ->columnSpanFull(),
            ]);
    }
}
