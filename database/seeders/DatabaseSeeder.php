<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\RoleSeeder;
use Modules\User\Database\Seeders\UserSeeder;
use Modules\User\Database\Seeders\VerifySeeder;

use Modules\Course\Database\Seeders\CourseSeeder;
use Modules\Course\Database\Seeders\ChapterSeeder;
use Modules\Course\Database\Seeders\SessionSeeder;
use Modules\Course\Database\Seeders\User_courseSeeder;
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

        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VerifySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(User_courseSeeder::class);
        

    }
}
