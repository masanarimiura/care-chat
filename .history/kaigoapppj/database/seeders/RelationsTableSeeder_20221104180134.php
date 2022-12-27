<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relation;

class RelationsTableSeeder extends Seeder
{
    public function run()
    {
        Relation::create([
            'relation' => '本人',
        ]);
        Relation::create([
            'relation' => '妻',
        ]);
        Relation::create([
            'relation' => '夫',
        ]);
        Relation::create([
            'relation' => '息子',
        ]);
        Relation::create([
            'relation' => '娘',
        ]);
        Relation::create([
            'relation' => '孫息子',
        ]);
        Relation::create([
            'relation' => '孫娘',
        ]);
        Relation::create([
            'relation' => '父親',
        ]);
        Relation::create([
            'relation' => '母親',
        ]);
        Relation::create([
            'relation' => '祖父',
        ]);
        Relation::create([
            'relation' => '祖母',
        ]);
        Relation::create([
            'relation' => '親戚',
        ]);
        Relation::create([
            'relation' => '知人',
        ]);
        Relation::create([
            'relation' => 'その他',
        ]);
    }
}
