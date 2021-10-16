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
            TagsTableSeeder::class,
            TagUserTableSeeder::class,
            JobUserTableSeeder::class,
            EngineersTableSeeder::class,
            ProductsTableSeeder::class,
            Product_imagesTableSeeder::class,
        ]);
    }
}
