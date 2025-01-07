<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collections;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Women',
                'slug' => 'women'
            ],
            [
                'name' => 'Men',
                'slug' => 'Men'
            ],
            [
                'name' => 'Kids',
                'slug' => 'kids'
            ],
            [
                'name' => 'Home and Lifestyle',
                'slug' => 'home-and-lifestyle'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Collections::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($collections as $key => $collection) {
            Collections::create($collection);
        }

    }
}
