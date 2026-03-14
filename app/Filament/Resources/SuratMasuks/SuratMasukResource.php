<?php

namespace App\Filament\Resources\SuratMasuks;

use App\Filament\Resources\SuratMasuks\Pages\EditSuratMasuk;
use App\Filament\Resources\SuratMasuks\Pages\ListSuratMasuk;
use App\Filament\Resources\SuratMasuks\Schemas\SuratMasukForm;
use App\Filament\Resources\SuratMasuks\Tables\SuratMasukTable;
use App\Models\SuratMasuk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'Pengajuan SK';

    protected static ?string $modelLabel = 'Pengajuan SK';

    protected static ?string $pluralModelLabel = 'Pengajuan SK Masuk';

    protected static ?int $navigationSort = 3;

    // Badge notifikasi: tampilkan jumlah pengajuan pending
    public static function getNavigationBadge(): ?string
    {
        $count = SuratMasuk::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    // Tidak bisa create dari admin — hanya read & update status
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return SuratMasukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuratMasukTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSuratMasuk::route('/'),
            'edit'  => EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}
