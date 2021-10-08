<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "aaa",
            'password' => "aaa",
            'nickname' => "aaa",
            'icon_image' => "icon_image/default.png",
            'email' => "aaa@gmail.com",

        ]);

        DB::table('users')->insert([
            'name' => "bbb",
            'password' => "bbb",
            'nickname' => "bbb",
            'icon_image' => "icon_image/default.png",
            'email' => "bbb@gmail.com",

        ]);

    }
}
