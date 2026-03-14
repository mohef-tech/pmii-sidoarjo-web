<?php

namespace App\Filament\Resources\Komisariat\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class KomisariatTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Komisariat')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('singkatan')
                    ->label('Singkatan')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('kampus')
                    ->label('Kampus')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('ketua')
                    ->label('Ketua')
                    ->searchable()
                    ->default('-'),

                TextColumn::make('whatsapp_ketua')
                    ->label('WhatsApp')
                    ->copyable()
                    ->copyMessage('Nomor WA disalin!')
                    ->icon('heroicon-o-phone')
                    ->default('-'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif'       => 'success',
                        'tidak_aktif' => 'danger',
                        default       => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'aktif'       => '✅ Aktif',
                        'tidak_aktif' => '❌ Tidak Aktif',
                        default       => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('nama', 'asc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif'       => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
