<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ClassModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Show the course creation form and the list of courses on the same page
    public function index()
    {
        $classes = ClassModel::all();

        $courses = Course::all();
        // Pass the courses and classes to the view
        return view('coach.course', compact('courses', 'classes'));
    }
    public function index2()
    {
        $userClasses = Auth::user()->classes;

        // Pass the courses and classes to the view
        return view('home.home', compact('userClasses'));
    }

    // Store a newly created course in storage
    public function store(Request $request)
    {
        // Validate the incoming request data

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'class_id' => 'required|exists:classmodels,id',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,mp4,avi,mov'
        ]);
        
        $file = $request->file("file")->store("images", "public");
        // Create a new course using the validated data

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file,
            'class_id' => $request->class_id,
        ]);
        
        // Redirect to the course management page with a success message
        return redirect()->route('coach.course')->with('success', 'Course created successfully!');
    }
    public function destroy(Course $class)
    {
        $class->delete();

        return redirect()->route('coach.course')->with('success', 'Class deleted successfully!');
    }
}
