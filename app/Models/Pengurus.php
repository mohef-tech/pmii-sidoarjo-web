<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'name',
        'position',
        'photo',
        'instagram',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    // 12 posisi baku sesuai notulen client
    public static function posisiList(): array
    {
        return [
            'Ketua Umum',
            'Sekretaris Umum',
            'Bendahara Umum',
            'Wakil Ketua 1',
            'Wakil Sekretaris 1',
            'Wakil Ketua 2',
            'Wakil Sekretaris 2',
            'Wakil Ketua 3',
            'Wakil Sekretaris 3',
            'Ketua KOPRI',
            'Sekretaris KOPRI',
            'Bendahara KOPRI',
        ];
    }
}
