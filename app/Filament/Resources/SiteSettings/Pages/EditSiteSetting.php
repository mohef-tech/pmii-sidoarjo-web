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
     * simpan juga nilai tipe media ke 'profil_media_type'.
     */
    protected function afterSave(): void
    {
        if ($this->record->key === 'profil_media') {
            $selectedType = $this->form->getState()['profil_media_type_field'] ?? 'image';
            SiteSetting::set('profil_media_type', $selectedType);
        }
    }
}
