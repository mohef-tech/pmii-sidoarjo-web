<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use App\Models\SiteSetting;
use Filament\Resources\Pages\EditRecord;

class EditSiteSetting extends EditRecord
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return []; // Tidak bisa delete setting
    }

    /**
     * Setelah record disimpan, jika key-nya adalah 'profil_media',
     * deteksi tipe media secara otomatis dari nilai URL yang tersimpan.
     *
     * Deteksi berbasis nilai (bukan form state) sehingga tidak bergantung
     * pada field dehydrated(false) yang tidak bisa dibaca via getState().
     */
    protected function afterSave(): void
    {
        if ($this->record->key === 'profil_media') {
            $value = $this->record->value ?? '';

            // Jika value mengandung domain video → simpan tipe 'video'
            $isVideo = str_contains($value, 'youtube.com')
                    || str_contains($value, 'youtu.be')
                    || str_contains($value, 'vimeo.com');

            SiteSetting::set('profil_media_type', $isVideo ? 'video' : 'image');
        }
    }
}
