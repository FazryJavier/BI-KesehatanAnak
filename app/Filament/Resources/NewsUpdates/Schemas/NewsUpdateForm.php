<?php

namespace App\Filament\Resources\NewsUpdates\Schemas;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use App\Models\NewsUpdate;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class NewsUpdateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, ?NewsUpdate $record): void {
                                if (blank($get('slug')) && filled($state)) {
                                    $set('slug', NewsUpdate::uniqueSlug($state, $record?->id));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('Bagian alamat halaman. Terisi otomatis dari judul.'),
                        Select::make('category')
                            ->label('Kategori')
                            ->options(NewsCategory::class)
                            ->default(NewsCategory::Announcement)
                            ->required()
                            ->native(false),
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(2)
                            ->maxLength(300)
                            ->helperText('Tampil di kartu berita. Kosongkan untuk memakai awal isi berita.')
                            ->columnSpanFull(),
                        MarkdownEditor::make('content')
                            ->label('Isi berita')
                            ->required()
                            ->toolbarButtons(['bold', 'italic', 'link', 'heading', 'bulletList', 'orderedList', 'blockquote', 'undo', 'redo'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Penerbitan')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('status')
                            ->options(NewsStatus::class)
                            ->default(NewsStatus::Draft)
                            ->required()
                            ->native(false),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal terbit')
                            ->helperText('Kosongkan untuk terbit saat disimpan. Tanggal di masa depan = terjadwal.'),
                        Toggle::make('is_featured')
                            ->label('Sorot di beranda'),
                    ])
                    ->columns(3),
                Section::make('Sumber informasi')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('source_name')
                            ->label('Nama sumber')
                            ->maxLength(255),
                        TextInput::make('source_url')
                            ->label('Tautan sumber')
                            ->url()
                            ->startsWith('https://')
                            ->maxLength(2048),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
