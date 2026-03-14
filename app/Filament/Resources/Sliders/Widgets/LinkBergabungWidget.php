<?php

namespace App\Filament\Resources\Sliders\Widgets;

use App\Models\SiteSetting;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class LinkBergabungWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.resources.sliders.widgets.link-bergabung-widget';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'link_bergabung' => SiteSetting::get('link_bergabung', ''),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('🔗 Link Tombol Bergabung')
                    ->description('URL yang dituju saat pengunjung mengklik tombol "Bergabung dengan Kami" di halaman utama.')
                    ->schema([
                        TextInput::make('link_bergabung')
                            ->label('Link "Bergabung dengan Kami"')
                            ->url()
                            ->placeholder('https://docs.google.com/spreadsheets/d/...')
                            ->helperText('Paste URL Google Form / Spreadsheet pendaftaran anggota di sini.')
                            ->columnSpanFull()
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        SiteSetting::set('link_bergabung', $state['link_bergabung'] ?? '');

        Notification::make()
            ->title('✅ Link Tombol Bergabung berhasil disimpan!')
            ->success()
            ->send();
    }
}
