<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
        'nama_pemohon',
        'whatsapp',
        'komisariat',
        'status',
        'catatan_admin',
        'file_permohonan',
        'file_ba_rapat',
        'file_ba_formatur',
        'file_struktur',
        'file_lpj',
        'file_rekomendasi',
        'file_ktp',
        'file_ktm',
        'file_sertifikat',
        'berkas_tambahan',
    ];

    protected $casts = [
        'status' => 'string',
        'berkas_tambahan' => 'array',
    ];

    public static function statusList(): array
    {
        return [
            'pending'   => 'Menunggu',
            'diproses'  => 'Diproses',
            'selesai'   => 'Selesai',
        ];
    }

    // Hitung jumlah pending untuk badge notifikasi
    public static function pendingCount(): int
    {
        return static::where('status', 'pending')->count();
    }
}
