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
                // Sembunyikan key internal yang dikelola di menu lain:
                // - profil_media_type : dikelola otomatis via afterSave()
                // - link_bergabung    : sudah dipindah ke Slider menu
                // - sk_requirements_config : dikelola di menu Pengajuan SK (⚙️ Pengaturan Form)
                $query->whereNotIn('key', [
                    'profil_media_type',
                    'link_bergabung',
                    'sk_requirements_config',
                ])
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

