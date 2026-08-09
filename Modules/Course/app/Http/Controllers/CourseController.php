<?php

namespace Modules\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate ;
use Modules\Course\Models\Course ;

class CourseController extends Controller
{
    public function create(Request $request)
    {

        Gate::authorize('create' , Course::class) ;



        $request->validate([

            'title' => 'required' ,
            'image' => 'required|image' ,
            'price' => 'required' ,
            'teacher_id' => 'required|exists:users,id'

        ]);
    
        $path = 
        Course::create([
            'title' => $request->title ,
            'image' => $request->image ,
            'price' => $request->price ,
            'teacher_id' => $request->teacher_id
            

        ]);

        return response()->json(['message' => 'course created successfulyy']);

    }

    public function update(Request $request , Course $course )
    {
        Gate::authorize('update' , $course) ;



        $request->validate([

            'title' => 'required' ,
            'image' => 'nullable|required|image' ,
            'price' => 'required' ,
            'teacher_id' => 'required|exists:users,id'

        ]);

        $path = $request->file('image')->store('course' , 'public');
    
        $course->update([
            'title' => $request->title ,
            'image' => $path ,
            'price' => 10 ,
            'teacher_id' => $request->teacher_id
            

        ]);

        return response()->json(['message' => 'course updated successfulyy']);
    }

    public function delete( Course $course)
    {
        Gate::authorize('delete' , $course) ;
        $course->delete();
        return response()->json(['message' => 'course deleted successfulyy']);

    }

    public function corses()
    {
       $courses = Course::all() ;

       return response()->json($courses);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }
}
