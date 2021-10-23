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
        $job_names = ['バックエンドエンジニア', 'フロントエンドエンジニア', 'データサイエンティスト', 'インフラエンジニア', 
                        '機械学習エンジニア', 'セールスエンジニア', 'リサーチエンジニア', 'データエンジ二ア', 'webデザイナー',
                        'ネットワークエンジニア', 'その他'];
        foreach($job_names as $job_name)
        {
            DB::table('jobs')->insert([
                'name' => $job_name,
            ]);
        }
    }
}
