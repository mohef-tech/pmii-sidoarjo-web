<?php

namespace App\Filament\Resources\EMagazines;

use App\Filament\Resources\EMagazines\Pages\CreateEMagazine;
use App\Filament\Resources\EMagazines\Pages\EditEMagazine;
use App\Filament\Resources\EMagazines\Pages\ListEMagazines;
use App\Filament\Resources\EMagazines\Schemas\EMagazineForm;
use App\Filament\Resources\EMagazines\Tables\EMagazinesTable;
use App\Models\EMagazine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EMagazineResource extends Resource
{
    protected static ?string $model = EMagazine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'E-Magazine KOPRI';

    protected static ?string $modelLabel = 'E-Magazine';

    protected static ?string $pluralModelLabel = 'E-Magazine KOPRI';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return EMagazineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EMagazinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListEMagazines::route('/'),
            'create' => CreateEMagazine::route('/create'),
            'edit'   => EditEMagazine::route('/{record}/edit'),
        ];
    }
}
