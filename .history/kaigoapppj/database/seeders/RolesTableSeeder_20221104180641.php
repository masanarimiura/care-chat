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
            'role' => '介護士',
        ]);
        Role::create([
            'role' => '薬剤師',
        ]);
        Role::create([
            'role' => '栄養士',
        ]);
        Role::create([
            'role' => '理学療法士',
        ]);
        Role::create([
            'role' => '作業療法士',
        ]);
        Role::create([
            'role' => '言語聴覚士',
        ]);
        Role::create([
            'role' => 'ケアマネージャー',
        ]);
        Role::create([
            'role' => '支援相談員',
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
