<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            'product_id' => 1,
            'image_path' => '/portfolio/1.png',
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'image_path' => '/portfolio/2.png',
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'image_path' => '/portfolio/3.png',
        ]);
    }
}
