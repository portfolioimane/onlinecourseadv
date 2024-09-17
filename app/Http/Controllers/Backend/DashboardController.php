<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();
        $totalEnrollments = Enrollment::count();

        return view('backend.dashboard', compact('totalCourses', 'totalLessons', 'totalEnrollments'));
    }
}
