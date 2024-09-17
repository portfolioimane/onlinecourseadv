<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('enrollment')->latest()->paginate(10);
        return view('backend.payments.index', compact('payments'));
    }

    public function create()
    {
        $enrollments = Enrollment::all();
        return view('backend.payments.create', compact('enrollments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ]);

        Payment::create($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Payment created successfully.');
    }

    public function edit(Payment $payment)
    {
        $enrollments = Enrollment::all();
        return view('backend.payments.edit', compact('payment', 'enrollments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
    }
}
