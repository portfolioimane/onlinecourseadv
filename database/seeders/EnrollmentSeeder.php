<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $studentId = User::where('role', User::ROLE_STUDENT)->first()->id;
        $courseId = Course::first()->id; // Assuming at least one course exists

        Enrollment::insert([
            [
                'user_id' => $studentId,
                'course_id' => $courseId,
            ],
        ]);
    }
}
