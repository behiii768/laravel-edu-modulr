<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([

                'title' => 'laravel' ,
                'image' => '1.jpg' ,
                'price' => 2000 ,
                'teacher_id' => 1

        ]) ;  

    }
}
