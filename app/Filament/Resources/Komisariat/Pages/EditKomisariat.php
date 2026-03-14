<?php

namespace App\Filament\Resources\Komisariat\Pages;

use App\Filament\Resources\Komisariat\KomisariatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKomisariat extends EditRecord
{
    protected static string $resource = KomisariatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
