<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'send_user_id' => 1,
            'receive_user_id' => 2,
            'message' => "こんにちは",
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'send_user_id' => 1,
            'receive_user_id' => 2,
            'message' => 'おはようございます．',
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'send_user_id' => 2,
            'receive_user_id' => 1,
            'message' => 'おはようございます．',
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'send_user_id' => 2,
            'receive_user_id' => 1,
            'message' => 'おはようございます．',
            'created_at' => Carbon::now(),
        ]);

    }
}
