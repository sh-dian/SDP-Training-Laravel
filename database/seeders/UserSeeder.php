<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'phone_no' => '011145896722',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@customer.com',
                'phone_no' => '011435243242',
                'password' => Hash::make('password'),
            ],
        ]);

        // Create Customer
        Customer::create([
            'user_id' => 2,
        ]);

        // Assign Admin Role
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\\Models\\User',
            'model_id' => 1,
        ]);

        // Assign Customer
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 2,
        ]);
    }
}
