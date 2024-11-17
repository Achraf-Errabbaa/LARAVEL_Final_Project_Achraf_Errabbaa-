<?php

namespace App\Http\Controllers;

use App\Models\ClassModel; // Assuming you have a ClassModel for classes
use App\Models\Lesson; // Assuming a Lesson model exists
use Illuminate\Http\Request;

class UserController extends Controller
{
    // View all available classes
    public function viewClasses()
    {
        $classes = ClassModel::all();
        return view('user.classes.index', compact('classes'));
    }

    // Enroll in a class
    public function enrollInClass($classId)
    {
        $class = ClassModel::find($classId);

        if ($class && $class->users()->count() < 10) { // Checking seat availability
            $class->users()->attach(auth()->user());
            return redirect()->route('user.classes.index')->with('success', 'Enrolled successfully');
        }

        return redirect()->route('user.classes.index')->with('error', 'Class is full or not available');
    }

    // View lessons of an enrolled class
    public function viewLessons($classId)
    {
        $class = ClassModel::find($classId);

        if (!$class) {
            return redirect()->route('user.classes.index')->with('error', 'Class not found');
        }

        // Only show lessons for enrolled classes
        if (!$class->users->contains(auth()->user())) {
            return redirect()->route('user.classes.index')->with('error', 'You are not enrolled in this class');
        }

        $lessons = $class->lessons; // Assuming a relationship between ClassModel and Lesson
        return view('user.lessons.index', compact('lessons'));
    }

    // View a single lesson
    public function viewLesson($classId, $lessonId)
    {
        $lesson = Lesson::find($lessonId);

        if (!$lesson) {
            return redirect()->route('user.classes.index')->with('error', 'Lesson not found');
        }

        return view('user.lessons.show', compact('lesson'));
    }
}

