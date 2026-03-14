<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $rawBerkas = \App\Models\SiteSetting::where('key', 'berkas_aktif')->first();
        $berkasAktif = $rawBerkas ? json_decode($rawBerkas->value, true) : [];

        $config = [];
        $berkasList = [
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

        foreach ($berkasList as $key => $label) {
            // Default active if not explicitly set to false in previous config
            $isActive = !isset($berkasAktif[$key]) ? true : (bool) $berkasAktif[$key];
            
            $config[] = [
                'key'         => $key,
                'label'       => $label,
                'is_required' => false, // Default all system files to not strictly required initially to match old behavior (or we can make them required, let's keep it safe)
                'is_active'   => $isActive,
                'is_system'   => true,
            ];
        }

        if ($rawBerkas) {
            $rawBerkas->update([
                'key'   => 'sk_requirements_config',
                'value' => json_encode($config),
                'label' => 'Konfigurasi Syarat SK',
            ]);
        } else {
            \App\Models\SiteSetting::create([
                'key'   => 'sk_requirements_config',
                'value' => json_encode($config),
                'label' => 'Konfigurasi Syarat SK',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $setting = \App\Models\SiteSetting::where('key', 'sk_requirements_config')->first();
        if ($setting) {
            $config = json_decode($setting->value, true) ?? [];
            $berkasAktif = [];
            foreach ($config as $item) {
                if ($item['is_system'] ?? false) {
                    $berkasAktif[$item['key']] = $item['is_active'];
                }
            }

            $setting->update([
                'key'   => 'berkas_aktif',
                'value' => json_encode($berkasAktif),
                'label' => 'Berkas Persyaratan Aktif',
            ]);
        }
    }
};
