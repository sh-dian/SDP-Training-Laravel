<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $customer = Customer::find($data['id']);

        $data['user']['name'] = $customer->user->name ?? null;
        $data['user']['phone_no'] = $customer->user->phone_no ?? null;
        $data['user']['email'] = $customer->user->email ?? null;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Customer
    {
        $record->update($data);
        $user = $record->user;
        $user->update($data['user']);

        return $record;
    }
}
