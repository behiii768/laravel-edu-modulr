<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Models\Role ;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role_id',
    'email_verify',
];

    public function role()
    {
        return $this->belongsTo(Role::class) ;
    }

    public function is_admin()
    {
        return $this->role->name === 'admin' ;
    }

    public function is_student()
    {
        return $this->role->name === 'student' ;
    } 

    public function is_teacher()
    {
        return $this->role->name === 'teacher' ;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class , 'user_courses');
    }
 
    public function user_courses()
    {
        return $this->hasMany(UserCourse::class) ;
    }

    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    } 
}
