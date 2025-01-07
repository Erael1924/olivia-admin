<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Casual',
            ],
            [
                'name' => 'Work Attire',
            ],
            [
                'name' => 'Weekend Outfits',
            ],
            [
                'name' => 'Beach Wear',
            ],
            [
                'name' => 'Formal Events',
            ],
            [
                'name' => 'Date Night Outfits',
            ],
            [
                'name' => 'Minimalist',
            ],
            [
                'name' => 'Skin Care',
            ],
            [
                'name' => 'Oily Skin',
            ],
            [
                'name' => 'Rounded Watch',
            ],
            [
                'name' => 'Denim',
            ],
            [
                'name' => 'Pink Decor',
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tags::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($tags as $tag) {
            Tags::create($tag);
        }

    }
}
