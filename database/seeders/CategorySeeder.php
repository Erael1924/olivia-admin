<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use App\Models\CategoryCollectionTypes;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'collection' => '1, 2, 3'
            ],
            [
                'name' => 'Bags',
                'slug' => 'bags',
                'collection' => '1, 2, 3'
            ],
            [
                'name' => 'Beauty',
                'slug' => 'beauty',
                'collection' => '1'
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'collection' => '1, 2, 3'
            ],
            [
                'name' => 'Furtinure',
                'slug' => 'furtinure',
                'collection' => '4'
            ],
            [
                'name' => 'Grooming',
                'slug' => 'grooming',
                'collection' => '2'
            ],
            [
                'name' => 'Home Decor',
                'slug' => 'home_decor',
                'collection' => '4'
            ],
            [
                'name' => 'Jewellery',
                'slug' => 'jewellery',
                'collection' => '1',
            ],
            [
                'name' => 'Shoes',
                'slug' => 'shoes',
                'collection' => '1, 2, 3',
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Categories::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($categories as $key => $category) {
            $collection = explode(",",$category['collection']);
            unset($category['collection']);
            $thisCategory = Categories::create($category);

            foreach ($collection as $collection) {
                CategoryCollectionTypes::create(['category_id' => $thisCategory->id, 'collection_id' => $collection]);
            }

        }

    }
}
