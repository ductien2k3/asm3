<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'User',
                'description' => '',
            ],
            [
                'name' => 'User Admin',
                'description' => '',
            ],
            [
                'name' => 'System Admin',
                'description' => '',
            ],
            [
                'name' => 'Super Admin',
                'description' => '',
            ],
        ]);
    }
}
