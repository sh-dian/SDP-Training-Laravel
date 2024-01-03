<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Customer
    {
        //create new user
        $user = new User();
        $user->fill($data['user']);
        $user->email_verified_at = now();
        $user->save();

        //create new Customer
        $customer = new Customer();
        $customer->fill($data);
        $customer->user_id = $user->id;
        $customer->save();

        return $customer;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
