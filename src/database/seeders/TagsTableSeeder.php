<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array[] = 
        array(
            'name'=>'ruby',
            'color'=>'#FF0000',
            'icon_path'=>'/icon/tags/file_type_ruby_icon_130186.png'
        );
        $array[] = 
        array(
            'name'=>'Go',
            'color'=>'#0000FF',
            'icon_path'=>'/icon/tags/golang_logo_icon_171073.png'
        );

        foreach ($array as $value) {
            DB::table('tags')->insert([
                'name' => $value['name'],
                'color' => $value['color'],
                'icon_path' => $value['icon_path'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
