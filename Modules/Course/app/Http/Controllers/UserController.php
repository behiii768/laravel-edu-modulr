<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User ;
use Modules\Course\Models\Course ;
use Modules\Course\Models\UserCourse ;
use App\Models\Section ;
 
class UserController extends Controller
{
    public function userCourse(Request $request , Course $course)
    {
        $user = $request->user();
        $courseId = $course->id ;

        $studentCourse = UserCourse::where('user_id' , $user->id)->where('course_id' , $courseId)->first() ;
        $isTeacherOfCourse = ($user->is_teacher() && $course->teacher_id === $user->id);

        if (! $studentCourse && !$user->is_admin() && ! $isTeacherOfCourse ) {

            return response()->json(['message' => 'این دوره برای کسانی که ثبت نام کرده اند قابل مشاهده هست'] , 403);

        }

        $section = $course->chapter()->with('section')->get() ;

        return response()->json([

            'message' => 'جلسات برای شما قابل مشاهده هست' ,
    
            'sections' => $section


        ]);


    }
}
