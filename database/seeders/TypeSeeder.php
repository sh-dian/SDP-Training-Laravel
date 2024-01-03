<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name' => "Badminton Court",
        ]);

        Type::create([
            'name' => "Tennis Court",
        ]);

        Type::create([
            'name' => "Basketball Court",
        ]);

        Type::create([
            'name' => "Soccer Field",
        ]);
    }
}
