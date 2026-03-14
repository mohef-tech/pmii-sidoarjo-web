<?php

namespace App\Filament\Resources\ContactSettings\Pages;

use App\Filament\Resources\ContactSettings\ContactSettingResource;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;

class ManageContactSetting extends Page
{
    protected static string $resource = ContactSettingResource::class;

    public function getView(): string
    {
        return 'filament.resources.contact-settings.manage-contact-setting';
    }


    // Keys yang dikelola halaman ini
    private static array $keys = [
        'kontak_alamat',
        'kontak_email',
        'kontak_wa_list', // Pakai versi array json
        'sosmed_facebook',
        'sosmed_instagram',
        'sosmed_twitter',
        'sosmed_youtube',
    ];

    // Data form (diisi saat mount)
    public array $data = [];

    public function mount(): void
    {
        $this->data = collect(self::$keys)
            ->mapWithKeys(function ($key) {
                $val = SiteSetting::get($key, '');
                if ($key === 'kontak_wa_list') {
                    // Coba decode JSON dari string, jika kosong/invalid jadikan array kosong
                    $decoded = json_decode($val, true);
                    $val = (is_array($decoded) && count($decoded) > 0) ? $decoded : [['nomor' => '']];
                }
                return [$key => $val];
            })
            ->toArray();

        $this->form->fill($this->data);
    }

    public function form(Schema $schema): Schema
    {
        return ContactSettingResource::form($schema)
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach (self::$keys as $key) {
            $val = $state[$key] ?? '';
            if ($key === 'kontak_wa_list') {
                // Konversi kembali array dari repeater ke JSON string untuk disimpan
                $val = is_array($val) ? json_encode($val) : '[]';
            }
            SiteSetting::set($key, $val);
        }

        Notification::make()
            ->title('✅ Kontak berhasil disimpan!')
            ->body('Informasi kontak organisasi telah diperbarui.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('💾 Simpan Kontak')
                ->color('primary')
                ->action('save'),
        ];
    }
}
