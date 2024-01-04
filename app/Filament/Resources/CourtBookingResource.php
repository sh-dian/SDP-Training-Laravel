<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourtBookingResource\Pages;
use App\Filament\Resources\CourtBookingResource\RelationManagers;
use App\Models\Court;
use App\Models\CourtBooking;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourtBookingResource extends Resource
{
    protected static ?string $model = CourtBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('court_id')
                    ->label('Court')
                    // ->options(Court::pluck('name', 'id'))
                    ->relationship(name: 'court', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('customer_id')
                    // ->options(Customer::with('user')->get()->pluck('user.name', 'id'))
                    ->relationship(name: 'customer.user', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('hour')
                    ->required()
                    ->numeric()
                    ->suffix('Hour'),

                Forms\Components\DatePicker::make('date')
                    ->native(false)
                    ->required(),

                Forms\Components\TimePicker::make('start_time')
                    ->native(false)
                    ->required(),

                Forms\Components\TextInput::make('total_player')
                    ->required()
                    ->numeric()
                    ->suffix('Player'),

                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->disabled()
                    ->hiddenOn('create')
                    ->prefix('RM'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('court.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.user.name')
                    ->label('Customer')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hour')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date('d-M-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')->time('H:m'),
                // Tables\Columns\TextColumn::make('total_player')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('MYR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourtBookings::route('/'),
            'create' => Pages\CreateCourtBooking::route('/create'),
            'edit' => Pages\EditCourtBooking::route('/{record}/edit'),
        ];
    }
}
