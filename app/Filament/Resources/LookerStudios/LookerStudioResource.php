<?php

namespace App\Filament\Resources\LookerStudios;

use App\Filament\Resources\LookerStudios\Pages\CreateLookerStudio;
use App\Filament\Resources\LookerStudios\Pages\EditLookerStudio;
use App\Filament\Resources\LookerStudios\Pages\ListLookerStudios;
use App\Filament\Resources\LookerStudios\Schemas\LookerStudioForm;
use App\Filament\Resources\LookerStudios\Tables\LookerStudiosTable;
use App\Models\LookerStudio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LookerStudioResource extends Resource
{
    protected static ?string $model = LookerStudio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Looker Studio';

    protected static ?string $pluralModelLabel = 'Looker Studio';

    public static function form(Schema $schema): Schema
    {
        return LookerStudioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LookerStudiosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLookerStudios::route('/'),
            'create' => CreateLookerStudio::route('/create'),
            'edit' => EditLookerStudio::route('/{record}/edit'),
        ];
    }
}
