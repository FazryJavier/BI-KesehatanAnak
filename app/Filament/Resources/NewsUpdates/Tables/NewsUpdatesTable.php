<?php

namespace App\Filament\Resources\NewsUpdates\Tables;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewsUpdatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul')->searchable()->limit(60),
                TextColumn::make('category')->label('Kategori')->badge(),
                TextColumn::make('status')->badge(),
                IconColumn::make('is_featured')->label('Sorotan')->boolean(),
                TextColumn::make('published_at')->label('Terbit')->dateTime('j M Y H:i')->sortable(),
                TextColumn::make('author.username')->label('Penulis')->placeholder('—'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                SelectFilter::make('category')->options(NewsCategory::class),
                SelectFilter::make('status')->options(NewsStatus::class),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
