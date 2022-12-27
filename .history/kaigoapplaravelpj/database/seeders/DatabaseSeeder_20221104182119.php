<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RelationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ShopTypesTableSeeder::class);
    }
}
