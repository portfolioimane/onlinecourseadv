<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        // Ensure the lesson belongs to the course
        if ($lesson->course_id !== $course->id) {
            abort(404); // Or handle this situation as needed
        }

        // Check if the user is enrolled in the course
        $user = Auth::user();
        if ($user && !$user->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->route('frontend.courses.show', $course)->with('error', 'You need to enroll in the course to access this lesson.');
        }

        // Fetch previous and next lessons for navigation
        $previousLesson = Lesson::where('course_id', $course->id)
            ->where('id', '<', $lesson->id) // Get lessons with IDs less than the current lesson's ID
            ->orderBy('id', 'desc')
            ->first();
            
        $nextLesson = Lesson::where('course_id', $course->id)
            ->where('id', '>', $lesson->id) // Get lessons with IDs greater than the current lesson's ID
            ->orderBy('id', 'asc')
            ->first();

        // Prepare additional files if they exist
        $additionalFiles = [];
        if ($lesson->additional_files) {
            $additionalFiles = json_decode($lesson->additional_files, true);
        }

        return view('frontend.lessons.show', compact('course', 'lesson', 'previousLesson', 'nextLesson', 'additionalFiles'));
    }
}
