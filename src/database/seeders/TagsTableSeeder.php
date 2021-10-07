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
            'tag_name'=>'ruby',
            'color'=>'#FF0000',
            'tag_icon'=>'/icon/tags/file_type_ruby_icon_130186.png'
        );
        $array[] = 
        array(
            'tag_name'=>'Go',
            'color'=>'#0000FF',
            'tag_icon'=>'/icon/tags/golang_logo_icon_171073.png'
        );

        foreach ($array as $value) {
            DB::table('tags')->insert([
                'tag_name' => $value['tag_name'],
                'color' => $value['color'],
                'tag_icon' => $value['tag_icon'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
