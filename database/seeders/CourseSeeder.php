<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $instructorId = User::where('role', User::ROLE_INSTRUCTOR)->first()->id;
        $categoryId = Category::first()->id; // Assuming at least one category exists

        Course::insert([
            [
                'user_id' => $instructorId,
                'category_id' => $categoryId,
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of web development with HTML, CSS, and JavaScript.',
                'price' => 100.00,
                'thumbnail' => 'intro-web-dev.jpg',
            ],
            [
                'user_id' => $instructorId,
                'category_id' => $categoryId,
                'title' => 'Advanced Web Design',
                'description' => 'Master advanced web design techniques and best practices.',
                'price' => 150.00,
                'thumbnail' => 'advanced-web-design.jpg',
            ],
        ]);
    }
}
