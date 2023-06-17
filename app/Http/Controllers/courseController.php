<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class courseController extends Controller
{

    public function storeCourse(Request $request){
        $request->validate([
            'course_name' => 'required|unique:courses|max:255',
        ]);
    
        $course = new Course;
        $course->course_name = $request->course_name;
        $course->save();
        return redirect()->back();
    }

    public function editCourse(Request $request){
        $courses = Course::find($request->courseID);
        $courses->course_name = $request->editCourseName;
        $courses->save();

        return response()->json(['success' => true, 'message' => 'You have edited the course sucessfully.']);
    }

public function delete(Request $request, $id){
    $courses = Course::find($id);
    
    if($courses){
          $courses->delete();
          return response()->json(['success' => true, 'message' => 'You have deleted the course successfully']);
    }return response()->json(['success' => false, 'message' => 'Error']);
}

    
}
