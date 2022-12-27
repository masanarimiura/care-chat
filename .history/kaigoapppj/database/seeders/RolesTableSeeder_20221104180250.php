<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relation;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'relation' => '本人',
        ]);
    }
}
