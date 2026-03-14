<?php

namespace App\Filament\Resources\SuratMasuks\Schemas;

use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class SuratMasukForm
{
    public static function getActiveRequirements(): array
    {
        $rawConfig = \App\Models\SiteSetting::get('sk_requirements_config');
        $config = $rawConfig ? json_decode($rawConfig, true) : [];
        return collect($config)
            ->filter(fn ($item) => $item['is_active'] ?? true)
            ->toArray();
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ── Informasi Pemohon ────────────────────────────────────────────
            Section::make('Informasi Pemohon')
                ->columns(2)
                ->schema([
                    Placeholder::make('nama_pemohon')
                        ->label('Nama Pemohon')
                        ->content(fn ($record) => $record?->nama_pemohon ?? '-'),

                    Placeholder::make('komisariat')
                        ->label('Komisariat')
                        ->content(fn ($record) => $record?->komisariat ?? '-'),

                    Placeholder::make('whatsapp')
                        ->label('Nomor WhatsApp')
                        ->content(fn ($record) => $record?->whatsapp ?? '-'),

                    Placeholder::make('created_at')
                        ->label('Tanggal Pengajuan')
                        ->content(fn ($record) => $record?->created_at?->format('d M Y, H:i') ?? '-'),
                ]),

            // ── Tombol WhatsApp langsung ─────────────────────────────────────
            Actions::make([
                Action::make('chat_wa')
                    ->label('💬 Chat WhatsApp Pemohon')
                    ->color('success')
                    ->url(function ($record) {
                        if (!$record?->whatsapp) return null;
                        // Normalisasi nomor: hilangkan 0 di depan, tambah 62
                        $nomor = preg_replace('/\D/', '', $record->whatsapp);
                        if (str_starts_with($nomor, '0')) {
                            $nomor = '62' . substr($nomor, 1);
                        } elseif (!str_starts_with($nomor, '62')) {
                            $nomor = '62' . $nomor;
                        }
                        $pesan = urlencode(
                            "Assalamu'alaikum Kak {$record->nama_pemohon},\n" .
                            "Kami dari PC PMII Kabupaten Sidoarjo ingin menginformasikan perkembangan pengajuan SK Komisariat {$record->komisariat} Anda.\n\n" .
                            "Terima kasih 🙏"
                        );
                        return "https://wa.me/{$nomor}?text={$pesan}";
                    })
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !empty($record?->whatsapp)),
            ])->columnSpanFull(),

            // ── Berkas Persyaratan ────────────────────────────────────────────
            Section::make('Berkas Persyaratan')
                ->description(fn ($record) => self::berkasRingkasan($record))
                ->schema(
                    collect(self::getActiveRequirements())->map(function ($item) {
                        $field = $item['key'];
                        $label = $item['label'];
                        $isSystem = $item['is_system'] ?? false;

                        return Placeholder::make($field)
                            ->label($label)
                            ->content(function ($record) use ($field, $label, $isSystem) {
                                if ($isSystem) {
                                    $path = $record?->$field;
                                } else {
                                    $path = $record?->berkas_tambahan[$field] ?? null;
                                }

                                if (!$path) {
                                    return new HtmlString(
                                        '<span style="color:#ef4444;font-weight:600;">✗ Belum diupload</span>'
                                    );
                                }
                                $url  = asset('storage/' . $path);
                                $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                $icon = in_array($ext, ['jpg','jpeg','png','webp','gif']) ? '🖼️' : '📄';
                                return new HtmlString(
                                    '<span style="color:#16a34a;font-weight:600;">✓ Sudah diupload</span> &nbsp;' .
                                    "<a href=\"{$url}\" target=\"_blank\" " .
                                    "style=\"color:#2563eb;text-decoration:underline;\">".
                                    "{$icon} Lihat / Download</a>"
                                );
                            });
                    })->values()->toArray()
                ),

            // ── Status & Catatan Admin ───────────────────────────────────────
            Section::make('Tindak Lanjut')
                ->schema([
                    Select::make('status')
                        ->label('Status Pengajuan')
                        ->options([
                            'pending'  => '⏳ Menunggu',
                            'diproses' => '🔄 Diproses',
                            'selesai'  => '✅ Selesai',
                        ])
                        ->required(),

                    Textarea::make('catatan_admin')
                        ->label('Catatan Admin')
                        ->placeholder('Tambahkan catatan, alasan, atau instruksi...')
                        ->nullable()
                        ->rows(3)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    private static function berkasRingkasan($record): string
    {
        if (!$record) return '';
        $requirements = self::getActiveRequirements();
        $total  = count($requirements);
        
        $terisi = collect($requirements)
            ->filter(function ($item) use ($record) {
                $field = $item['key'];
                if ($item['is_system'] ?? false) {
                    return !empty($record->$field);
                } else {
                    return !empty($record->berkas_tambahan[$field] ?? null);
                }
            })
            ->count();
            
        return "{$terisi} dari {$total} berkas sudah diupload";
    }
}
