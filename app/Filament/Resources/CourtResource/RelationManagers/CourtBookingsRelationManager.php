<?php

namespace App\Filament\Resources\CourtResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourtBookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'courtBookings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('court_id')
            ->columns([
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
                Tables\Columns\TextColumn::make('total_price')
                    ->money('MYR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
