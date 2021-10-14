<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JobUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_user')->insert([
            'user_id' => 1,
            'job_id' => 1,
        ]);
        DB::table('job_user')->insert([
            'user_id' => 1,
            'job_id' => 2,
        ]);
        DB::table('job_user')->insert([
            'user_id' => 1,
            'job_id' => 3,
        ]);
        DB::table('job_user')->insert([
            'user_id' => 2,
            'job_id' => 1,
        ]);
    }
}
