<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student', 'course')->latest()->paginate(10);
        return view('backend.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('backend.enrollments.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:enrolled,completed',
        ]);

        Enrollment::create($request->all());

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $users = User::all();
        $courses = Course::all();
        return view('backend.enrollments.edit', compact('enrollment', 'users', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:enrolled,completed',
        ]);

        $enrollment->update($request->all());

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
