<?php

namespace App\Filament\Customer\Resources\CourtResource\Pages;

use App\Filament\Customer\Resources\CourtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourt extends EditRecord
{
    protected static string $resource = CourtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
