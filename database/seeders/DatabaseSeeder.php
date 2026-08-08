<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        $this->call(roleSeeder::class);
        $this->call(userSeeder::class);
        $this->call(verifySeeder::class);
        $this->call(courseSeeder::class);
        $this->call(chapterSeeder::class);
        $this->call(sessionSeeder::class);
        $this->call(fileSeeder::class);
        $this->call(user_courseSeeder::class);
        

    }
}
