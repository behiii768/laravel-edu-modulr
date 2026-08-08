<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course ;
use App\Models\UserCourse ;
use App\Models\User ;

class EnrollmentController extends Controller
{
    public function store(Request $request , Course $course)
    {
        $user = $request->user() ;
        if (!$user->is_student()) {

                return response()->json([

                    'message' => 'کاربر باید دانشجو باشد'

                ],422);
        }

        $alreadyExist = $user->user_courses()->where('course_id', $course->id)->exists();

        if ($alreadyExist){

            return response()->json([

                'message' => 'این کاربر قبلا ثبت نام کرده است'

            ]);
        }

        UserCourse::create([

            'user_id' => $user->id ,
            'course_id' => $course->id

        ]) ;

        return response()->json([

            'message' => 'شما در دوره ثبت نام شدید'

        ]);

    }

    public function grant(Request $request , Course $course , User $student)
    {
        $teacher = $request->user();

        if (! $teacher->is_teacher() && ! $teacher->is_admin()){

             return response()->json([

                    'message' => 'فقط مدرس یا ادمین میتونه به دانشجو دسترسی بدهد'
             ]);
        }

        if ( ! $teacher->is_admin() && $course->id !== $teacher->id ) {

                return response()->json(['message' => 'فقط مدرس میتونه دسترسی بده']);
        }

        if (! $student->is_student()){

          return response()->json(['message'=> 'کاربر انتخاب شده دانشجو نیست']);
        }

        $alreadyExist = UserCourse::where('user_id' , $student->id)->where('course_id' , $course->id)->exist();
        if (! $alreadyExist ){

                return response()->json(['message' => ' شما قبلا ثبت نام کرده اید']) ;
        }

        UserCourse::create([

            'user_id' => $student->id ,
            'course_id' => $course->id
        ]);

        return response()->json([ 'message' => 'دسترسی دانشجو به دوره با موفقیت فعال شد.']);
    }

}
 