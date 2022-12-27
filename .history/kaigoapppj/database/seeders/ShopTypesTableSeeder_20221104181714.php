<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopType;

class ShopTypesTableSeeder extends Seeder
{
    public function run()
    {
        ShopType::create([
            'name' => '病院',
        ]);
        ShopType::create([
            'name' => '診療所',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
        ShopType::create([
            'name' => '',
        ]);
    }
}
