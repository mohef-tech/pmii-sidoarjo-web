<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'event_date', 'location', 'image', 'is_published'];

    protected $casts = [
        'event_date' => 'date',
        'is_published' => 'boolean',
    ];
}
