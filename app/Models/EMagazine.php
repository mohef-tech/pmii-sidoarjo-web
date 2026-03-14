<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EMagazine extends Model
{
    protected $table = 'e_magazines';

    protected $fillable = [
        'title',
        'edition',
        'cover_image',
        'file',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
