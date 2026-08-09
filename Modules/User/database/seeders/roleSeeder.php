<?php

namespace Modules\User\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('roles')->insert(['name' => 'admin']) ; 
           DB::table('roles')->insert(['name' => 'student']) ; 
           DB::table('roles')->insert(['name' => 'teacher']) ; 
           
           

    }
}
