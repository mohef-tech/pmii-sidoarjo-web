<?php

namespace App\Filament\Resources\SuratMasuks\Pages;

use App\Filament\Resources\SuratMasuks\SuratMasukResource;
use App\Models\Komisariat;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Section;

class ListSuratMasuk extends ListRecords
{
    protected static string $resource = SuratMasukResource::class;

    /** Daftar semua berkas yang bisa di-toggle */
    private const BERKAS_LIST = [
        'file_permohonan'  => 'Surat Permohonan SK',
        'file_ba_rapat'    => 'Berita Acara Rapat Tahunan / Rapat Anggota',
        'file_ba_formatur' => 'Berita Acara Formatur',
        'file_struktur'    => 'Struktur Kepengurusan',
        'file_lpj'         => 'Laporan Pertanggungjawaban Pengurus Demisioner',
        'file_rekomendasi' => 'Rekomendasi IKA (Jika Ada)',
        'file_ktp'         => 'Scan KTP Pemohon',
        'file_ktm'         => 'Scan KTM / Kartu Anggota',
        'file_sertifikat'  => 'Sertifikat PKD / PKL',
    ];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pengaturan')
                ->label('⚙️ Pengaturan Form')
                ->color('gray')
                ->slideOver()
                ->form([

                    // ── Section 1: Komisariat ────────────────────────────────
                    Section::make('🏢 Daftar Komisariat')
                        ->description('Nama-nama komisariat ini akan muncul sebagai pilihan di form pengajuan SK publik.')
                        ->schema([
                            Repeater::make('komisariat_list')
                                ->label('')
                                ->schema([
                                    TextInput::make('nama')
                                        ->label('Nama Komisariat')
                                        ->required()
                                        ->placeholder('contoh: Komisariat UMSIDA')
                                        ->maxLength(255),
                                ])
                                ->addActionLabel('+ Tambah Komisariat')
                                ->reorderable()
                                ->collapsible()
                                ->cloneable()
                                ->itemLabel(fn (array $state): ?string => $state['nama'] ?? null)
                                ->defaultItems(0),
                        ]),

                    // ── Section 2: Toggle Berkas ─────────────────────────────
                    Section::make('📂 Berkas Persyaratan')
                        ->description('Atur daftar berkas pengajuan SK. Anda dapat menambah, mengubah, menonaktifkan, dan mengatur apakah berkas wajib diisi lho!')
                        ->schema([
                            Repeater::make('sk_requirements_config')
                                ->label('')
                                ->schema([
                                    \Filament\Forms\Components\Hidden::make('key'),

                                    TextInput::make('label')
                                        ->label('Nama / Label Berkas')
                                        ->required()
                                        ->placeholder('contoh: Surat Rekomendasi Khusus'),

                                    Toggle::make('is_required')
                                        ->label('Wajib Diisi')
                                        ->inline(true)
                                        ->default(false),

                                    Toggle::make('is_active')
                                        ->label('Aktif (Tampil)')
                                        ->inline(true)
                                        ->default(true),

                                    // Hidden field untuk menandai apakah itu field sistem
                                    \Filament\Forms\Components\Hidden::make('is_system')
                                        ->default(false),
                                ])
                                ->addActionLabel('+ Tambah Berkas Persyaratan')
                                ->reorderable()
                                ->collapsible()
                                ->cloneable()
                                ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                // Matikan fitur hapus untuk field bawaan agar tidak merusak relasi
                                ->deleteAction(
                                    fn ($action) => 
                                        $action->hidden(fn (array $arguments, Repeater $component): bool => 
                                            $component->getRawItemState($arguments['item'])['is_system'] ?? false
                                        )
                                )
                                ->defaultItems(0),
                        ]),
                ])
                ->fillForm(function (): array {
                    // Muat daftar komisariat dari DB
                    $komisariat = Komisariat::orderBy('nama')
                        ->pluck('nama')
                        ->map(fn ($nama) => ['nama' => $nama])
                        ->toArray();

                    // Muat konfigurasi requirements
                    $rawConfig = SiteSetting::get('sk_requirements_config');
                    $skRequirementsConfig = $rawConfig ? json_decode($rawConfig, true) : [];

                    return [
                        'komisariat_list' => $komisariat,
                        'sk_requirements_config' => $skRequirementsConfig,
                    ];
                })
                ->action(function (array $data): void {
                    // ── Sync komisariat ──────────────────────────────────────
                    $inputNama = collect($data['komisariat_list'] ?? [])
                        ->pluck('nama')
                        ->filter()
                        ->unique()
                        ->values();

                    // Hapus yang tidak ada lagi di input
                    Komisariat::whereNotIn('nama', $inputNama)->delete();

                    // Tambah yang belum ada
                    $existing = Komisariat::pluck('nama');
                    $inputNama->diff($existing)->each(
                        fn ($nama) => Komisariat::create(['nama' => $nama, 'status' => 'aktif'])
                    );

                    // ── Simpan konfigurasi requirements ───────────────────────
                    $skRequirementsConfig = collect($data['sk_requirements_config'] ?? [])->map(function ($item) {
                        // Pastikan field custom memiliki key yang valid jika belum ada
                        if (empty($item['key'])) {
                            $item['key'] = \Illuminate\Support\Str::slug($item['label'], '_');
                        }
                        return $item;
                    })->toArray();

                    SiteSetting::set('sk_requirements_config', json_encode($skRequirementsConfig));

                    \Filament\Notifications\Notification::make()
                        ->title('Pengaturan Form SK Berhasil Disimpan')
                        ->success()
                        ->send();
                })
                ->modalHeading('Pengaturan Form Pengajuan SK')
                ->modalDescription('Kelola daftar komisariat dan konfigurasi berkas persyaratan dengan dinamis.')
                ->modalSubmitActionLabel('💾 Simpan Pengaturan')
                ->modalWidth('2xl'),
        ];
    }
}
