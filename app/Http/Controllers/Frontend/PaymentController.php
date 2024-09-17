<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(Course $course)
    {
        // Ensure the user is enrolled in the course
        $user = Auth::user();
        if (!$user->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->route('frontend.courses.show', $course)->with('error', 'You need to enroll in the course before making a payment.');
        }

        return view('frontend.payments.create', compact('course')); // Create view in resources/views/frontend/payments/create.blade.php
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->course_id = $course->id;
        $payment->amount = $request->input('amount');
        $payment->payment_method = $request->input('payment_method');
        $payment->status = 'completed'; // You can add logic for different payment statuses
        $payment->save();

        return redirect()->route('frontend.courses.show', $course)->with('success', 'Payment processed successfully.');
    }
}
