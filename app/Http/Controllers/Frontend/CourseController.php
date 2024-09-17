<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->get();
        return view('frontend.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $lessons = $course->lessons;
        $isEnrolled = Auth::check() ? Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists() : false;

        return view('frontend.courses.show', compact('course', 'lessons', 'isEnrolled'));
    }

    public function enroll(Request $request, Course $course)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('frontend.home')->with('error', 'You need to log in to enroll.');
        }

        Enrollment::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            ['user_id' => $user->id, 'course_id' => $course->id]
        );

        return redirect()->route('frontend.courses.show', $course)->with('success', 'Successfully enrolled in the course.');
    }
}
