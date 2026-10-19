<?php

namespace App\Filament\Resources\NewsUpdates;

use App\Filament\Resources\NewsUpdates\Pages\CreateNewsUpdate;
use App\Filament\Resources\NewsUpdates\Pages\EditNewsUpdate;
use App\Filament\Resources\NewsUpdates\Pages\ListNewsUpdates;
use App\Filament\Resources\NewsUpdates\Schemas\NewsUpdateForm;
use App\Filament\Resources\NewsUpdates\Tables\NewsUpdatesTable;
use App\Models\NewsUpdate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NewsUpdateResource extends Resource
{
    protected static ?string $model = NewsUpdate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Latest News';

    protected static ?string $pluralModelLabel = 'Latest News';

    public static function form(Schema $schema): Schema
    {
        return NewsUpdateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsUpdatesTable::configure($table);
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
            'index' => ListNewsUpdates::route('/'),
            'create' => CreateNewsUpdate::route('/create'),
            'edit' => EditNewsUpdate::route('/{record}/edit'),
        ];
    }
}
