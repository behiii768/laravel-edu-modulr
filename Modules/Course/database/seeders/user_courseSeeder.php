<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class User_courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_courses')->insert([

            'user_id' => 1 ,
            'course_id' => 1


        ]);
    }
}
