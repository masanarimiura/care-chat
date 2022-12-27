<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        ShopType::create([
            'name' => '墨田総合病院',
            'shop_type_id' => '1',
            'email' => 'dkflhjadf@icloud.com',
            'number' => '3919783718237',
        ]);
        ShopType::create([
            'name' => '小野田クリニック',
            'shop_type_id' => '2',
            'email' => 'dkflhjaｓdf@icloud.com',
            'number' => '3919783718237',
        ]);
        ShopType::create([
            'name' => '墨田総合病院',
            'shop_type_id' => '1',
            'email' => 'dkflhjadf@icloud.com',
            'number' => '3919783718237',
        ]);
        ShopType::create([
            'name' => '墨田総合病院',
            'shop_type_id' => '1',
            'email' => 'dkflhjadf@icloud.com',
            'number' => '3919783718237',
        ]);
    }
}
