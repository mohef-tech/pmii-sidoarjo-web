<?php

namespace App\Filament\Resources\SuratMasuks\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SuratMasukTable
{
    private static array $fileFields = [
        'file_permohonan', 'file_ba_rapat', 'file_ba_formatur',
        'file_struktur', 'file_lpj', 'file_rekomendasi',
        'file_ktp', 'file_ktm', 'file_sertifikat',
    ];

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('komisariat')
                    ->label('Komisariat')
                    ->searchable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->copyable()
                    ->copyMessage('Nomor WA disalin!')
                    ->icon('heroicon-o-phone'),

                // Kolom ringkasan berkas: X / 9
                TextColumn::make('berkas_lengkap')
                    ->label('Berkas')
                    ->state(function ($record): string {
                        $total  = count(self::$fileFields);
                        $terisi = collect(self::$fileFields)
                            ->filter(fn ($f) => !empty($record->$f))
                            ->count();
                        return "{$terisi} / {$total}";
                    })
                    ->badge()
                    ->color(function ($record): string {
                        $total  = count(self::$fileFields);
                        $terisi = collect(self::$fileFields)
                            ->filter(fn ($f) => !empty($record->$f))
                            ->count();
                        return match (true) {
                            $terisi === $total => 'success',
                            $terisi >= 5       => 'warning',
                            default            => 'danger',
                        };
                    })
                    ->tooltip('Jumlah berkas dari 9 persyaratan yang sudah diupload'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'  => 'warning',
                        'diproses' => 'info',
                        'selesai'  => 'success',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending'  => '⏳ Menunggu',
                        'diproses' => '🔄 Diproses',
                        'selesai'  => '✅ Selesai',
                        default    => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Menunggu',
                        'diproses' => 'Diproses',
                        'selesai'  => 'Selesai',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Proses / Lihat Berkas'),
            ])
            ->toolbarActions([]);
    }
}
