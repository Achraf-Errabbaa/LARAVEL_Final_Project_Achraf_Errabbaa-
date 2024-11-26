<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Show the list of lessons and the lesson creation form for a specific course
    public function index(Course $course)
    {
        // Fetch lessons associated with the course
        $lessons = $course->lessons;

        // Pass the lessons and course to the view
        return view('coach.lesson', compact('lessons', 'course'));
    }
    public function lessonView(Course $course, Lesson $lesson)
    {
        $courses = Course::all();
        $lessons = $course->lessons;
        return view('user.lessons', compact('lessons','course', 'courses', 'lesson'));
    }

    // Store a newly created lesson for a specific course
    public function store(Request $request, Course $course)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'video' => 'nullable|file|mimes:mp4,mov,avi|max:102400', // Video validation
        'pdf' => 'nullable|file|mimes:pdf|max:10240', // PDF validation
        'content' => 'required|string',
    ]);

    // Create a new Lesson instance and fill it with the request data
    $lesson = new Lesson([
        'title' => $request->title,
        'description' => $request->description,
        'duration' => $request->duration,
        'content' => $request->content,
    ]);

    // Handle video upload (if provided)
    if ($request->hasFile('video')) {
        $lesson->video = $request->file('video')->store('lesson_videos', 'public'); // Save video file in 'public/lesson_videos'
    }

    // Handle PDF upload (if provided)
    if ($request->hasFile('pdf')) {
        $lesson->pdf = $request->file('pdf')->store('lesson_pdfs', 'public'); // Save PDF file in 'public/lesson_pdfs'
    }

    // Associate the lesson with the course and save it
    $course->lessons()->save($lesson);

    // Redirect back to the lessons page with a success message
    return redirect()->route('coach.lesson', ['course' => $course->id])->with('success', 'Lesson created successfully.');
}

    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('coach.lesson', ['course' => $course->id])->with('success', 'Lesson deleted successfully!');
    }
}

