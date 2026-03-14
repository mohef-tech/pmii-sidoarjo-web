<?php

namespace App\Filament\Resources\Komisariat;

use App\Filament\Resources\Komisariat\Pages\CreateKomisariat;
use App\Filament\Resources\Komisariat\Pages\EditKomisariat;
use App\Filament\Resources\Komisariat\Pages\ListKomisariat;
use App\Filament\Resources\Komisariat\Schemas\KomisariatForm;
use App\Filament\Resources\Komisariat\Tables\KomisariatTable;
use App\Models\Komisariat as KomisariatModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KomisariatResource extends Resource
{
    protected static ?string $model = KomisariatModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Komisariat';

    protected static ?string $modelLabel = 'Komisariat';

    protected static ?string $pluralModelLabel = 'Data Komisariat';

    // Sembunyikan dari sidebar — dikelola via modal di halaman Pengajuan SK
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return KomisariatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KomisariatTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListKomisariat::route('/'),
            'create' => CreateKomisariat::route('/create'),
            'edit'   => EditKomisariat::route('/{record}/edit'),
        ];
    }
}
