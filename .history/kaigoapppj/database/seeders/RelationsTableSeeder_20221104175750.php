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
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
        Relation::create([
            'relation' => '',
        ]);
    }
}
