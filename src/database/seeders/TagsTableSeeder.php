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
            'name'=>'Ruby',
            'color'=>'#EE0000',
            'icon_path'=>'/icon/tags/Ruby.svg'
        );
        $array[] = 
        array(
            'name'=>'Go',
            'color'=>'#3399FF',
            'icon_path'=>'/icon/tags/Go.svg'
        );
        $array[] = 
        array(
            'name'=>'Python',
            'color'=>'#FFFF66',
            'icon_path'=>'/icon/tags/Python.svg'
        );
        $array[] = 
        array(
            'name'=>'JavaScript',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/JavaScript.svg'
        );
        $array[] = 
        array(
            'name'=>'C',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/C.svg'
        );
        $array[] = 
        array(
            'name'=>'C++',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/C++.svg'
        );
        $array[] = 
        array(
            'name'=>'Haskell',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/Haskell.svg'
        );
        $array[] = 
        array(
            'name'=>'Julia',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/Julia.svg'
        );
        $array[] = 
        array(
            'name'=>'OCaml',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/OCaml.svg'
        );
        $array[] = 
        array(
            'name'=>'Perl',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/Perl.svg'
        );
        $array[] = 
        array(
            'name'=>'php',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/php.svg'
        );
        $array[] = 
        array(
            'name'=>'R',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/R.svg'
        );
        $array[] = 
        array(
            'name'=>'Scheme',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/Scheme.svg'
        );
        $array[] = 
        array(
            'name'=>'Swift',
            'color'=>'#808000',
            'icon_path'=>'/icon/tags/Swift.svg'
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
