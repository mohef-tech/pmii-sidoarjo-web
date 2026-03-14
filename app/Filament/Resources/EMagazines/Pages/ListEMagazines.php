<?php

namespace App\Filament\Resources\EMagazines\Pages;

use App\Filament\Resources\EMagazines\EMagazineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEMagazines extends ListRecords
{
    protected static string $resource = EMagazineResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
