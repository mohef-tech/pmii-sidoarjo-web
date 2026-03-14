<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komisariat extends Model
{
    protected $table = 'komisariat';

    protected $fillable = [
        'nama',
        'singkatan',
        'kampus',
        'kota',
        'ketua',
        'whatsapp_ketua',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public static function statusList(): array
    {
        return [
            'aktif'       => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
        ];
    }

    /** Daftar nama komisariat untuk dropdown di form pengajuan SK */
    public static function forSelect(): array
    {
        return static::where('status', 'aktif')
            ->orderBy('nama')
            ->pluck('nama', 'nama')
            ->toArray();
    }
}
