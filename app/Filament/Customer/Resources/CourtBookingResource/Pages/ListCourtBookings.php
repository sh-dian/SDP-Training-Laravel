<?php

namespace App\Filament\Customer\Resources\CourtBookingResource\Pages;

use App\Filament\Customer\Resources\CourtBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourtBookings extends ListRecords
{
    protected static string $resource = CourtBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
