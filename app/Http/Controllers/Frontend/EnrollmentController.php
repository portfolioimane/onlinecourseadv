<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $enrollments = $user->enrollments()->with('course')->get();
        return view('frontend.enrollments.index', compact('enrollments')); // Create view in resources/views/frontend/enrollments/index.blade.php
    }
}
