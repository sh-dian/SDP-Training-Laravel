<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\CourtBookingResource\Pages;
use App\Filament\Customer\Resources\CourtBookingResource\RelationManagers;
use App\Models\Court;
use App\Models\CourtBooking;
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
                    ->options(Court::pluck('name', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('hour')
                    ->required()
                    ->numeric()
                    ->suffix('Hour'),

                Forms\Components\DatePicker::make('date')
                    ->required(),

                Forms\Components\TimePicker::make('start_time')
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
        $user = auth()->user();

        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('customer_id', $user->customer->id))
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
