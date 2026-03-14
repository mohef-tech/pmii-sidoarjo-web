<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) =>
                // Sembunyikan profil_media_type dan link_bergabung
                // link_bergabung sudah dipindah ke Slider menu
                $query->whereNotIn('key', ['profil_media_type', 'link_bergabung'])
            )
            ->columns([
                TextColumn::make('label')
                    ->label('Keterangan')
                    ->searchable(),

                TextColumn::make('key')
                    ->label('Kode')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make()->label('Edit Nilai'),
            ])
            ->toolbarActions([]); // Tidak bisa tambah/hapus dari table
    }
}

