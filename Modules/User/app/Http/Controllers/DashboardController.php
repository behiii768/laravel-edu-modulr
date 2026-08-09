<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function studentCourses(Request $request)
    {
        $user = $request->user();

        if (!$user->is_student()){

            return response()->json(['message' => 'این بخش برای دانشجویان است']);
        }

        $courses = $user->courses()->get(); 

        return response()->json($courses);
    }

    public function teacherCourses(Request $request)
    {
        $user = $request->user();

        if (! $user->is_teacher() && ! $user->is_admin()) {
        return response()->json([
            'message' => 'این بخش برای مدرسین است'
            ], 403);
        }

        $courses = $user->taughtCourses()->get();

        return response()->json($courses);
    }

    public function teacherStudents(Request $request)
    {
        $user = $request->user();
        if (!$user->is_teacher() && !$user->is_admin()) {
        return response()->json([
            'message' => 'این بخش مخصوص مدرسین است.'
        ], 403);
        }
        $courses = $user->taughtCourses()->with('students')->get();

        return response()->json($courses);
    }
}
