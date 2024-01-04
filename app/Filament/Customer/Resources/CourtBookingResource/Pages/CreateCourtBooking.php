<?php

namespace App\Filament\Customer\Resources\CourtBookingResource\Pages;

use App\Filament\Customer\Resources\CourtBookingResource;
use App\Models\Court;
use App\Models\CourtBooking;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourtBooking extends CreateRecord
{
    protected static string $resource = CourtBookingResource::class;

    protected function handleRecordCreation(array $data): CourtBooking
    {
        //create new booking
        $booking = new CourtBooking();
        $booking->fill($data);

        //total price calculation
        $court = Court::find($data['court_id']);
        $totalPrice = $court->price * $data['hour'];
        $booking->total_price = $totalPrice;
        $booking->customer_id = auth()->user()->customer->id;

        $booking->save();

        return $booking;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
