<?php

namespace Modules\User\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;
use Carbon\Carbon ;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Str;

class verifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('verification_codes')->insert([

            'email' => 'sara@test.com',
            'code' => Hash::make('654321'),
            'purpose' => 'register',
            'expire_at' => now()->addMinutes(10),
            'verify_at' => now(),
            'verify_token' => hash('sha256', Str::random(64)),


        ]);
    }
}
