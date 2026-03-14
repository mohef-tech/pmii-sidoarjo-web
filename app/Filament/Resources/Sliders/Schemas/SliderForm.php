<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('image')
                ->label('Foto Slider')
                ->image()
                ->directory('sliders')
                ->disk('public')
                ->required()
                ->imageCropAspectRatio('16:9')          // paksa crop 16:9 sebelum upload
                ->imageResizeMode('cover')               // isi area crop tanpa distorsi
                ->imageResizeTargetWidth('1920')         // resize ke lebar max 1920px
                ->imageResizeTargetHeight('1080')        // resize ke tinggi max 1080px
                ->maxSize(5120)                          // maks 5MB
                ->helperText('⚠️ Gunakan foto landscape (horizontal) ukuran minimal 1280×720px. Foto portrait/vertikal akan dicrop otomatis ke rasio 16:9.')
                ->columnSpanFull(),

            TextInput::make('title')
                ->label('Judul (opsional)')
                ->nullable(),

            TextInput::make('subtitle')
                ->label('Sub-judul (opsional)')
                ->nullable(),

            TextInput::make('urutan')
                ->label('Urutan Tampil')
                ->numeric()
                ->default(0),

            Toggle::make('is_active')
                ->label('Aktif / Tampil di Hero')
                ->default(true),
        ]);
    }
}
