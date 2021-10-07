<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engineers')->insert([
            'user_id' => 1,
            'introduction' => "よろしくお願いします．",
            'age' => 23,
            'gender' => 0,
            'github_url' => 'github.com/naoki183',
            'facebook_url' => 'facebook.com',
            'qiita_url' => 'qiita.com',
            
        ]);
    }
}
