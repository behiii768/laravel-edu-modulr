<?php

namespace Modules\User\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            'name' => 'ali' ,
            'email' => 'ali@gmail.com' ,
            'password' => '123456' ,
            'email_verify' => Carbon::now() ,
            'role_id' => 1

        ]) ;  

    }
}
