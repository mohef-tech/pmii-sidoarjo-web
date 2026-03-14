<?php

namespace App\Filament\Resources\Downloads\Schemas;

use App\Models\Download;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul File')
                ->required()
                ->columnSpanFull(),

            Select::make('category')
                ->label('Kategori')
                ->options(array_combine(
                    Download::categoryList(),
                    Download::categoryList()
                ))
                ->required(),

            Select::make('type')
                ->label('Tipe File')
                ->options([
                    'PDF'  => 'PDF',
                    'Word' => 'Word (DOC/DOCX)',
                    'MP3'  => 'MP3 (Audio)',
                    'PNG'  => 'PNG / JPG (Gambar)',
                    'ZIP'  => 'ZIP',
                    'Lainnya' => 'Lainnya',
                ])
                ->required(),

            Textarea::make('description')
                ->label('Deskripsi (opsional)')
                ->nullable()
                ->columnSpanFull(),

            FileUpload::make('file')
                ->label('Upload File')
                ->directory('downloads')
                ->disk('public')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'audio/mpeg',
                    'image/png',
                    'image/jpeg',
                    'application/zip',
                ])
                ->maxSize(20480) // 20MB
                ->required()
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Tampilkan di Website')
                ->default(true),
        ]);
    }
}
