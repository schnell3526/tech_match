<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_user')->insert([
            'user_id' => 1,
            'tag_id' => 1,
        ]);
        DB::table('tag_user')->insert([
            'user_id' => 1,
            'tag_id' => 2,
        ]);
        
        DB::table('tag_user')->insert([
            'user_id' => 2,
            'tag_id' => 1,
        ]);
    }
}
