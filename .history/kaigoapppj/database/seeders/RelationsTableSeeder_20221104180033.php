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
            'relation' => '孫',
        ]);
        Relation::create([
            'relation' => '父親',
        ]);
        Relation::create([
            'relation' => '母親',
        ]);
        Relation::create([
            'relation' => '親族',
        ]);
        Relation::create([
            'relation' => '知人',
        ]);
        Relation::create([
            'relation' => '',
        ]);
    }
}
