<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'role' => '医師',
        ]);
        Role::create([
            'role' => '看護師',
        ]);
        Role::create([
            'role' => '介護し',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
        Role::create([
            'role' => '',
        ]);
    }
}
