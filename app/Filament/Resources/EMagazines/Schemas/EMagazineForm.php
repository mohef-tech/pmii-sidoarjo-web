<?php

namespace App\Filament\Resources\EMagazines\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EMagazineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul E-Magazine')
                ->required()
                ->columnSpanFull(),

            TextInput::make('edition')
                ->label('Edisi / Nomor')
                ->placeholder('Contoh: Vol. 1, Edisi Maret 2024')
                ->nullable(),

            Toggle::make('is_published')
                ->label('Publikasikan')
                ->default(true),

            FileUpload::make('cover_image')
                ->label('Gambar Cover')
                ->image()
                ->directory('e-magazine/covers')
                ->disk('public')
                ->nullable()
                ->columnSpanFull(),

            FileUpload::make('file')
                ->label('File PDF E-Magazine')
                ->directory('e-magazine/files')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf'])
                ->maxSize(51200) // 50MB
                ->required()
                ->columnSpanFull(),
        ]);
    }
}
