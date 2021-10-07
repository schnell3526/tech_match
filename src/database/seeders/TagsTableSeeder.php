<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('tags')->insert([
            'tag_name' => 'php',
            'color' => '#422c41',
            'tag_icon' => '/public/image',
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'python',
            'color' => '#004391',
            'tag_icon' => '/public/image',
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'C言語',
            'color' => '#EAE8F2',
            'tag_icon' => '/public/image',
        ]);
        
        
        
    }
}
