<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        ShopType::create([
            'name' => '病院',
        ]);
    }
}
