<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter ;
use Illuminate\Support\Facades\Gate ;

class ChapterController extends Controller
{
    public function create(Request $request)
    {

        Gate::authorize('create' , Chapter::class) ;



        $request->validate([

            'title' => 'required' ,
            'course_id' => 'required|exists:courses,id'

        ]);
    
        
        Chapter::create([
            'title' => $request->title ,
            'course_id' => $request->course_id
            

        ]);

        return response()->json(['message' => 'chapter created successfulyy']);

    }

    public function update(Request $request , Chapter $chapter )
    {
        Gate::authorize('update' , $chapter) ;



        $request->validate([

            'title' => 'required' ,
            'course_id' => 'required|exists:courses,id'

        ]);

    
        $chapter->update([
            'title' => $request->title ,
            'course_id' => $request->course_id
            

        ]);

        return response()->json(['message' => 'chapter updated successfulyy']);
    }

    public function delete( Chapter $chapter)
    {
        Gate::authorize('delete' , $chapter) ;
        $chapter->delete();
        return response()->json(['message' => 'chapter deleted successfulyy']);

    }

    public function index()
    {
       $chapters = Chapter::all() ;

       return response()->json($chapters);
    }

    public function show(Chapter $chapter)
    {
        return response()->json($chapter);
    }
}
