<?php

namespace App\Filament\Resources\Pengurus;

use App\Filament\Resources\Pengurus\Pages\CreatePengurus;
use App\Filament\Resources\Pengurus\Pages\EditPengurus;
use App\Filament\Resources\Pengurus\Pages\ListPengurus;
use App\Filament\Resources\Pengurus\Schemas\PengurusForm;
use App\Filament\Resources\Pengurus\Tables\PengurusTable;
use App\Models\Pengurus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengurusResource extends Resource
{
    protected static ?string $model = Pengurus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $slug = 'pengurus';

    protected static ?string $navigationLabel = 'Pengurus';

    protected static ?string $modelLabel = 'Pengurus';

    protected static ?string $pluralModelLabel = 'Daftar Pengurus';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return PengurusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengurusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPengurus::route('/'),
            'create' => CreatePengurus::route('/create'),
            'edit'   => EditPengurus::route('/{record}/edit'),
        ];
    }
}
