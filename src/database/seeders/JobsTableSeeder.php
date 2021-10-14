<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_name = ['バックエンドエンジニア', 'フロントエンドエンジニア', 'データサイエンティスト'];
        foreach($jobs_name as $job_name)
        {
            DB::table('jobs')->insert([
            'name' => $job_name,
            ]);
        }
    }
}
