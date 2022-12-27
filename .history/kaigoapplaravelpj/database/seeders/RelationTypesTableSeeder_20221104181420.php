<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relation;

class RelationsTableSeeder extends Seeder
{
    public function run()
    {
        Relation::create([
            'name' => '本人',
        ]);
        Relation::create([
            'name' => '妻',
        ]);
        Relation::create([
            'name' => '夫',
        ]);
        Relation::create([
            'name' => '息子',
        ]);
        Relation::create([
            'name' => '娘',
        ]);
        Relation::create([
            'name' => '孫息子',
        ]);
        Relation::create([
            'name' => '孫娘',
        ]);
        Relation::create([
            'name' => '父親',
        ]);
        Relation::create([
            'name' => '母親',
        ]);
        Relation::create([
            'name' => '祖父',
        ]);
        Relation::create([
            'name' => '祖母',
        ]);
        Relation::create([
            'name' => '親族',
        ]);
        Relation::create([
            'name' => '知人',
        ]);
        Relation::create([
            'name' => 'その他',
        ]);
    }
}
