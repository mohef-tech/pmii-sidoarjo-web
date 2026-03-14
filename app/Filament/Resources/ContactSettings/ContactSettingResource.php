<?php

namespace App\Filament\Resources\ContactSettings;

use App\Filament\Resources\ContactSettings\Pages\ManageContactSetting;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

use Filament\Forms\Components\Repeater;

class ContactSettingResource extends Resource
{
    // Resource ini tidak terikat ke model SiteSetting secara CRUD.
    // Kita gunakan halaman custom (ManageContactSetting) yang mengelola
    // beberapa key SiteSetting sekaligus dalam satu form.
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $navigationLabel = 'Kontak';

    protected static ?string $modelLabel = 'Kontak';

    protected static ?string $pluralModelLabel = 'Kontak Organisasi';

    protected static ?int $navigationSort = 9;


    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('📍 Informasi Lokasi')
                ->description('Alamat fisik kantor/sekretariat organisasi.')
                ->schema([
                    Textarea::make('kontak_alamat')
                        ->label('Alamat / Lokasi')
                        ->placeholder('Jl. Capung No.114, Kwadengan Barat, Lemahputro, Sidoarjo...')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Section::make('📬 Kontak Digital')
                ->description('Email dan nomor WhatsApp yang bisa dihubungi.')
                ->columns(2)
                ->schema([
                    TextInput::make('kontak_email')
                        ->label('Alamat Email')
                        ->email()
                        ->placeholder('pcpmiisda@gmail.com'),

                    Repeater::make('kontak_wa_list')
                        ->label('Nomor WhatsApp')
                        ->schema([
                            TextInput::make('nomor')
                                ->label('Nomor HP')
                                ->placeholder('6282232619640')
                                ->required()
                                ->helperText('Tanpa tanda +, contoh: 6282232619640'),
                        ])
                        ->addActionLabel('➕ Tambah Nomor WA Lagi')
                        ->defaultItems(1)
                        ->reorderableWithButtons()
                        ->collapsible()
                        ->grid(1),
                ]),

            Section::make('🌐 Media Sosial')
                ->description('Kosongkan jika tidak ada / tidak ingin ditampilkan.')
                ->columns(2)
                ->schema([
                    TextInput::make('sosmed_facebook')
                        ->label('Facebook')
                        ->url()
                        ->placeholder('https://facebook.com/pcpmii.sidoarjo'),

                    TextInput::make('sosmed_instagram')
                        ->label('Instagram')
                        ->url()
                        ->placeholder('https://instagram.com/pcpmii.sidoarjo'),

                    TextInput::make('sosmed_twitter')
                        ->label('Twitter / X')
                        ->url()
                        ->placeholder('https://twitter.com/pcpmii_sidoarjo'),

                    TextInput::make('sosmed_youtube')
                        ->label('YouTube')
                        ->url()
                        ->placeholder('https://youtube.com/@pcpmiisidoarjo'),
                ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageContactSetting::route('/'),
        ];
    }
}
