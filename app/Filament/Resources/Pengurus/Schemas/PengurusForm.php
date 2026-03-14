<?php

namespace App\Filament\Resources\Pengurus\Schemas;

use App\Models\Pengurus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PengurusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required(),

            Select::make('position')
                ->label('Jabatan')
                ->options(array_combine(
                    Pengurus::posisiList(),
                    Pengurus::posisiList()
                ))
                ->required(),

            TextInput::make('instagram')
                ->label('Instagram (opsional)')
                ->prefix('@')
                ->nullable(),

            TextInput::make('urutan')
                ->label('Urutan Tampil')
                ->numeric()
                ->default(0),

            FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->directory('pengurus')
                ->disk('public')
                ->nullable()
                ->columnSpanFull(),

            Toggle::make('is_active')
                ->label('Aktif / Tampil di Website')
                ->default(true),
        ]);
    }
}
