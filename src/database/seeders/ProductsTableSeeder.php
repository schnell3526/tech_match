<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'user_id' => 1,
            'title' => 'Tech Match',
            'description' => 'エンジニアとエンジニアのマッチングサービスです．',
            'product_url' => 'Tech_Match.com',
            'src_url' => 'https://github.com/schnell3526/tech_match',
        ]);

        DB::table('products')->insert([
            'user_id' => 1,
            'title' => '競馬予測.com',
            'description' => '競馬の順位を予測します．',
            'product_url' => 'KeibaYosoku.com',
            'src_url' => 'https://github.com/naoki183/cs50_finalproject',
        ]);
    }
}
