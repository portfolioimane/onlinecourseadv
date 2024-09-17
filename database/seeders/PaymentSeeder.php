<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Course;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $studentId = User::where('role', User::ROLE_STUDENT)->first()->id;
        $courseId = Course::first()->id; // Assuming at least one course exists

        Payment::insert([
            [
                'user_id' => $studentId,
                'course_id' => $courseId,
                'amount' => 100.00,
                'payment_method' => 'Credit Card',
                'status' => 'Completed',
            ],
        ]);
    }
}
