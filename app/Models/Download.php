<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'title',
        'category',
        'file',
        'type',
        'description',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public static function categoryList(): array
    {
        return [
            'Produk Hukum',
            'Materi Kaderisasi',
            'Atribut & Lagu',
            'Draft Musyawarah',
            'Lainnya',
        ];
    }
}
