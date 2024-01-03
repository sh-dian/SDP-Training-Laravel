<?php

namespace App\Filament\Widgets;

use App\Models\Court;
use App\Models\CourtBooking;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Court', Court::all()->count()),
            Stat::make('Total Customer', Customer::all()->count()),
            Stat::make('Total Booking', CourtBooking::all()->count()),
        ];
    }
}
