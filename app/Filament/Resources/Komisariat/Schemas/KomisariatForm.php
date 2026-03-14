<?php

namespace App\Filament\Resources\Komisariat\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Text;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KomisariatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Data Komisariat')
                ->columns(2)
                ->schema([
                    Text::make('nama')
                        ->label('Nama Komisariat')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Text::make('singkatan')
                        ->label('Singkatan')
                        ->placeholder('contoh: PMII Umsida')
                        ->maxLength(100),

                    Text::make('kampus')
                        ->label('Nama Kampus / Perguruan Tinggi')
                        ->placeholder('contoh: Universitas Muhammadiyah Sidoarjo')
                        ->maxLength(255),

                    Text::make('kota')
                        ->label('Kota / Kecamatan')
                        ->default('Sidoarjo')
                        ->maxLength(100),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'aktif'       => 'Aktif',
                            'tidak_aktif' => 'Tidak Aktif',
                        ])
                        ->default('aktif')
                        ->required(),
                ]),

            Section::make('Kontak Ketua')
                ->columns(2)
                ->schema([
                    Text::make('ketua')
                        ->label('Nama Ketua')
                        ->maxLength(255),

                    Text::make('whatsapp_ketua')
                        ->label('WhatsApp Ketua')
                        ->tel()
                        ->placeholder('08xxxxxxxxxx')
                        ->maxLength(20),
                ]),

            Section::make('Keterangan Tambahan')
                ->schema([
                    Textarea::make('keterangan')
                        ->label('Keterangan')
                        ->placeholder('Catatan tambahan tentang komisariat ini...')
                        ->nullable()
                        ->rows(3)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
