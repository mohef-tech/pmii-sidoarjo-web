<?php

namespace App\Filament\Resources\Pengurus\Pages;

use App\Filament\Resources\Pengurus\PengurusResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPengurus extends EditRecord
{
    protected static string $resource = PengurusResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
