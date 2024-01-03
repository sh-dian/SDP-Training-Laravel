<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = "INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
        (1, 'admin', 'web', '2023-09-02 02:31:30', '2023-09-02 02:31:30'),
        (2, 'customer', 'web', '2023-09-02 02:31:31', '2023-09-09 23:03:04');";

        DB::insert($roles);
    }
}
