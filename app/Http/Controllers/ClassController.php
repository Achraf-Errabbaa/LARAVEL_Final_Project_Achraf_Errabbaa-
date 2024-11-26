<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // Show the form and list of classes
    public function index()
    {
        $classes = ClassModel::all();
        
        
        return view('coach.class', compact('classes'));
    }
    public function viewCourses(ClassModel $class)
    {
        $classes = ClassModel::all();
        $courses = $class->courses;
        return view('coach.course', compact('class','classes', 'courses'));
    }
    public function viewClass(ClassModel $class)
    {
        $classes = ClassModel::all();
        $courses = $class->courses;
        return view('user.classes', compact('class','classes', 'courses'));
    }

    public function enroll(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'class_id' => 'required',
    ]);
    $class = ClassModel::where('id', $request->class_id)->first();
    if ($class->users()->where('user_id', auth()->id())->exists()) {
        return redirect()->back()->with('error', 'You are already enrolled in this class.');
    }

    if ($class->users()->count() >= $class->max_participants) {
        return redirect()->back()->with('error', 'This class is already full.');
    }


    $class->max_participants-= 1;
    $class->save();

    $user = User::where('id', $request->user_id)->first();
    $user->classes()->attach($request->class_id);
    return back();
    

    // $class = ClassModel::findOrFail($classId);

    // // Check if the class is full
    // if ($class->users()->count() >= $class->max_participants) {
    //     return redirect()->back()->with('error', 'This class is already full.');
    // }

    // // Check if the user is already enrolled
    

    // // Enroll the user
    // $class->users()->attach(auth()->id());

    // return redirect()->back()->with('success', 'You have successfully enrolled in the class.');
}
    


    // Store a newly created class
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1|max:21',
            'category' => 'required|string|max:255',
            'start' => 'required',
            'end' => 'required',
        ]);

        ClassModel::create($request->only('name', 'max_participants', 'category', 'start' ,'end'));

        return redirect()->route('coach.class')->with('success', 'Class created successfully!');
    }

    // Delete a class
    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('coach.class')->with('success', 'Class deleted successfully!');
    }
}
