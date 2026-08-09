<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate ;
use Modules\Course\Models\Section ;

class SectionController extends Controller
{
     public function create(Request $request)
    {

        Gate::authorize('create' , Section::class) ;



        $request->validate([

            'title' => 'required' ,
            'description' => 'required' ,
            'video' => 'required|file|max:20000' ,
            'file' => 'required|file|mimes:pdf,zip,rar,docx,pptx|max:2000' ,
            'chapter_id' => 'required|exists:chapters,id'

        ]);
    
        $videoPath = $request->file('video')->store('videos' , 'public');
        $filePath = $request->file('file')->store('files' , 'public');
        Section::create([
            'title' => $request->title ,
            'description' => $request->description ,
            'video' => $videoPath ,
            'file' => $filePath ,           
            'chapter_id' => $request->chapter_id
            

        ]);

        return response()->json(['message' => 'section created successfulyy']);

    }

    public function update(Request $request , Section $section )
    {
        Gate::authorize('update' , $section) ;



        $request->validate([

            'title' => 'required' ,
            'description' => 'required' ,
            'file' => 'required|file|mimes:mp4,pdf|max:52000' ,
            'type' => 'required|string|in:video,pdf' ,
            'chapter_id' => 'required|exists:chapter,id'

        ]);

        // $videoPath = $request->file('video')->store('videos' , 'public');
        $filePath = $request->file('file')->store('files' , 'public');
        Section::create([
            'title' => $request->title ,
            'description' => $request->description ,
            'type' => $request->type ,
            'file' => $request->$filePath ,           
            'chapter_id' => $request->chapter_id
            

        ]);

        return response()->json(['message' => 'section updated successfulyy']);
    }

    public function delete( Section $section)
    {
        Gate::authorize('delete' , $section) ;
        $section->delete();
        return response()->json(['message' => 'section deleted successfulyy']);

    }

    public function index()
    {
       $sections = Section::all() ;

       return response()->json($sections);
    }

    public function show(Section $section)
    {
        return response()->json($section);
    }
}
