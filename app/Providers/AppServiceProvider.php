<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate ;
use App\Models\Course ;
use App\Policies\CoursePolicy ;
use App\Models\Chapter ;
use App\Models\Section ;
use App\Policies\ChapterPolicy ;
use App\Policies\SectionPolicy ;
use Illuminate\Support\Facades\Schema; // ۱. این خط را اضافه کنید

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::policy(Course::class , CoursePolicy::class) ;
        Gate::policy(Chapter::class , ChapterPolicy::class) ;
        Gate::policy(Section::class , SectionPolicy::class) ;

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ۲. این خط را در متد بوت بنویسید
        Schema::defaultStringLength(191);
    }
}
