<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        ShopType::create([
            'name' => '墨田総合病院',
            'shop_type_id' => '',
        ]);
    }
}
