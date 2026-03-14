<?php

namespace App\Filament\Resources\EMagazines\Pages;

use App\Filament\Resources\EMagazines\EMagazineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEMagazine extends EditRecord
{
    protected static string $resource = EMagazineResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
