<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            JobsTableSeeder::class,
            Users_TagsTableSeeder::class,
            Users_JobsTableSeeder::class,
            EngineerTableSeeder::class,
        ]);
    }
}
