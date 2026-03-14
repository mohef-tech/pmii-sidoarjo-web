<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Placeholder::make('key')
                ->label('Kode Setting')
                ->content(fn ($record) => $record?->key ?? '-'),

            Placeholder::make('label')
                ->label('Keterangan')
                ->content(fn ($record) => $record?->label ?? '-'),

            // ─────────────────────────────────────────────────────────────────
            // profil_media → satu form: pilih tipe, lalu upload foto / isi URL
            // ─────────────────────────────────────────────────────────────────
            Select::make('profil_media_type_field')
                ->label('Tipe Media')
                ->options([
                    'image' => '🖼️  Foto / Gambar (upload)',
                    'video' => '🎬  Video (URL embed YouTube / Vimeo)',
                ])
                ->default(fn ($record) => SiteSetting::get('profil_media_type', 'image'))
                ->live()   // reactive: field bawah berubah sesuai pilihan
                ->helperText('Pilih jenis media yang akan ditampilkan di section Profil.')
                ->dehydrated(false) // tidak disimpan ke kolom `value` record ini
                ->columnSpanFull()
                ->visible(fn ($record) => $record?->key === 'profil_media'),

            // Foto – muncul saat tipe = image
            FileUpload::make('value')
                ->label('Upload Foto')
                ->image()
                ->disk('public')
                ->directory('profil')
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('4:3')
                ->maxSize(3072)
                ->helperText('Format: JPG, PNG, WebP. Maks. 3 MB.')
                ->columnSpanFull()
                ->visible(fn ($get, $record) =>
                    $record?->key === 'profil_media' &&
                    ($get('profil_media_type_field') ?? SiteSetting::get('profil_media_type', 'image')) === 'image'
                ),

            // Video URL – muncul saat tipe = video
            TextInput::make('value')
                ->label('URL Embed Video')
                ->placeholder('https://www.youtube.com/embed/XXXX')
                ->helperText('Salin URL embed dari YouTube/Vimeo. Contoh: https://www.youtube.com/embed/dQw4w9WgXcQ')
                ->url()
                ->columnSpanFull()
                ->visible(fn ($get, $record) =>
                    $record?->key === 'profil_media' &&
                    ($get('profil_media_type_field') ?? SiteSetting::get('profil_media_type', 'image')) === 'video'
                ),

            // ── Textarea untuk deskripsi / tujuan / visi ────────────────────
            Textarea::make('value')
                ->label('Nilai')
                ->rows(4)
                ->columnSpanFull()
                ->visible(fn ($record) => in_array($record?->key, [
                    'profil_deskripsi', 'profil_tujuan', 'profil_visi',
                ])),

            // ── TextInput khusus angka statistik ─────────────────────────
            TextInput::make('value')
                ->label('Nilai Angka / Teks')
                ->required()
                ->columnSpanFull()
                ->visible(fn ($record) => in_array($record?->key, [
                    'anggota_aktif', 'alumni_kaderisasi', 'kegiatan_tahunan', 'publikasi_kajian',
                ])),

            // ── Input URL Link Khusus Statistik ─────────────────────────
            TextInput::make('link') // Kolom baru dari database
                ->label('Link URL Spesifik')
                ->url()
                ->placeholder('https://docs.google.com/spreadsheets/d/...')
                ->helperText('Isi tautan / URL Spreadsheet. Kosongkan jika tidak ada tautan klik.')
                ->columnSpanFull()
                ->visible(fn ($record) => in_array($record?->key, [
                    'anggota_aktif', 'alumni_kaderisasi', 'kegiatan_tahunan', 'publikasi_kajian',
                ])),

            // ── TextInput default untuk pengaturan lain (selain profil_xx dan angka statistik) ───────────
            TextInput::make('value')
                ->label('Nilai')
                ->required()
                ->columnSpanFull()
                ->visible(fn ($record) => !in_array($record?->key, [
                    'profil_media', 'profil_media_type',
                    'profil_deskripsi', 'profil_tujuan', 'profil_visi',
                    'anggota_aktif', 'alumni_kaderisasi', 'kegiatan_tahunan', 'publikasi_kajian',
                ])),
        ]);
    }
}
