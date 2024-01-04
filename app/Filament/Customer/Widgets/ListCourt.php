<?php

namespace App\Filament\Customer\Widgets;

use App\Filament\Customer\Resources\CourtBookingResource;
use App\Filament\Customer\Resources\CourtResource;
use App\Models\Court;
use App\Models\CourtBooking;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ListCourt extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(CourtResource::getEloquentQuery())
            ->columns([
                Tables\Columns\TextColumn::make('type.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Court Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('MYR')
                    ->sortable(),
            ])->actions([
                Tables\Actions\Action::make('book')
                    ->form([
                        Section::make('Choose Court')
                            ->schema([
                                Select::make('court_id')
                                    ->label('Court')
                                    ->options(Court::pluck('name', 'id'))
                                    ->required(),
                            ]),

                        Section::make('Booking Details')
                            ->columns(2)
                            ->schema([
                                DatePicker::make('date')
                                    ->date()
                                    ->native(false)
                                    ->required(),

                                TimePicker::make('start_time')
                                    ->native(false)
                                    ->required(),

                                TextInput::make('hour')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Hour'),

                                TextInput::make('total_player')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Player'),
                            ]),
                    ])->action(function (array $data, Court $record): void {
                        // dd($data);
                        $court = Court::find($data['court_id']);
                        $totalPrice = $court->price * $data['hour'];

                        $booking = $record->courtBookings()->create([
                            'customer_id' => auth()->user()->customer->id,
                            'court_id' => $data['court_id'],
                            'date' => $data['date'],
                            'start_time' => $data['start_time'],
                            'hour' => $data['hour'],
                            'total_player' => $data['total_player'],
                            'total_price' => $totalPrice,
                        ]);
                        $booking->save();
                    }),
            ]);
    }
}
