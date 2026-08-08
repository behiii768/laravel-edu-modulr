<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class sessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('sections')->insert([

            'title' => 'first' ,
            'descriptin' => 'dhjvvufhcmcmnvnc' ,
            'chapter_id' => 1 ,
            'file' => 'hdfhhjdjdsjh' ,
            'video' => 'first.mp4'

           ]) ;  

    }
}
