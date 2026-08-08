<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Models\User ;
use App\Models\Section ;

class Course extends Model
{
    protected $fillable = [

        'title' ,
        'price' ,
        'image' ,
        'user_id'


    ] ; 

    public function chapter()
    {
        return $this->hasMany(Chapter::class ) ;
    }

    public function user_courses()
    {
        return $this->hasMany(UserCourse::class) ;
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id', 'user_id');
    }
   
   
}
 
