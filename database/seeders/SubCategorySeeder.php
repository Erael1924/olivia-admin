<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategories;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Watches',
                'slug' => 'watches',
                'category_id' => 1
            ],
            [
                'name' => 'Handbags',
                'slug' => 'handbags',
                'category_id' => 2
            ],
            [
                'name' => 'Make Up',
                'slug' => 'make-up',
                'category_id' => 3
            ],
            [
                'name' => 'Tops',
                'slug' => 'tops',
                'category_id' => 4
            ],
            [
                'name' => 'Dresses',
                'slug' => 'dresses',
                'category_id' => 4
            ],
            [
                'name' => 'Living Room',
                'slug' => 'living-room',
                'category_id' => 5
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'category_id' => 5
            ],
            [
                'name' => 'Bed Room',
                'slug' => 'bed-room',
                'category_id' => 5
            ],
            [
                'name' => 'Body Care',
                'slug' => 'body-care',
                'category_id' => 6
            ],
            [
                'name' => 'Shorts',
                'slug' => 'shorts',
                'category_id' => 4
            ],
            [
                'name' => 'Wall Decor',
                'slug' => 'wall-decor',
                'category_id' => 7
            ],
            [
                'name' => 'Home Fragrance',
                'slug' => 'home-fragrance',
                'category_id' => 7
            ],
            [
                'name' => 'Shirts',
                'slug' => 'shirts',
                'category_id' => 4
            ],
            [
                'name' => 'Polos',
                'slug' => 'polos',
                'category_id' => 4
            ],
            [
                'name' => 'Socks',
                'slug' => 'socks',
                'category_id' => 4
            ],
            [
                'name' => 'Jewellery',
                'slug' => 'jewellery',
                'category_id' => 8,
            ],
            [
                'name' => 'Sneakers',
                'slug' => 'sneakers',
                'category_id' => 9,
            ],
            [
                'name' => 'Loafers',
                'slug' => 'loafers',
                'category_id' => 9,
            ],
            [
                'name' => 'Flats',
                'slug' => 'flats',
                'category_id' => 9,
            ],
            [
                'name' => 'Formal',
                'slug' => 'formal',
                'category_id' => 9,
            ],
            [
                'name' => 'Jeans',
                'slug' => 'jeans',
                'category_id' => 4
            ],
            [
                'name' => 'Boots',
                'slug' => 'boots',
                'category_id' => 9,
            ],
            [
                'name' => 'Blazer',
                'slug' => 'blazer',
                'category_id' => 4
            ],
            [
                'name' => 'Lightning',
                'slug' => 'lightning',
                'category_id' => 7
            ],
            [
                'name' => 'Decorative Accessories',
                'slug' => 'decorative-accessories',
                'category_id' => 7
            ],
            [
                'name' => 'Sandals',
                'slug' => 'sandals',
                'category_id' => 9,
            ],
            [
                'name' => 'Heels',
                'slug' => 'heels',
                'category_id' => 9,
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SubCategories::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($categories as $key => $category) {
            $thisCategory = SubCategories::create($category);

        }

    }
}
