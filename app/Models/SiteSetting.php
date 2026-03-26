<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'link',
        'label',
    ];

    // Helper: ambil nilai setting berdasarkan key
    public static function get(string $key, mixed $default = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    // Helper: set nilai setting
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Konversi URL YouTube biasa ke URL embed.
     *
     * Format yang didukung:
     *   https://www.youtube.com/watch?v=ID
     *   https://youtu.be/ID
     *   https://www.youtube.com/shorts/ID
     *   https://www.youtube.com/embed/ID  (sudah embed, langsung dikembalikan)
     *
     * @param  string|null  $url
     * @return string|null  URL embed, atau null jika bukan URL YouTube valid
     */
    public static function youtubeEmbedUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // Sudah berupa URL embed → kembalikan apa adanya
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        $id = null;

        // Format: youtu.be/ID
        if (preg_match('#youtu\.be/([a-zA-Z0-9_-]{11})#', $url, $m)) {
            $id = $m[1];
        }

        // Format: youtube.com/watch?v=ID  atau  youtube.com/shorts/ID
        if (!$id && preg_match('#youtube\.com/(?:watch\?(?:.*&)?v=|shorts/)([a-zA-Z0-9_-]{11})#', $url, $m)) {
            $id = $m[1];
        }

        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }
}
