<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Course;

class LessonSeeder extends Seeder
{
    public function run()
    {
        $courseId = Course::first()->id; // Assuming at least one course exists

        Lesson::insert([
            [
                'course_id' => $courseId,
                'title' => 'Getting Started with HTML',
                'content' => 'This lesson covers the basics of HTML structure.',
                'video_url' => 'html-intro.mp4',
                'video_file' => 'videos/html-intro.mp4', // Example path for video file
                'video_embed' => '<iframe src="https://www.youtube.com/embed/example1" frameborder="0" allowfullscreen></iframe>', // Example embed code
                'additional_files' => json_encode([]), // No additional files for this lesson
            ],
            [
                'course_id' => $courseId,
                'title' => 'CSS Fundamentals',
                'content' => 'Learn about CSS styling and layout techniques.',
                'video_url' => 'css-fundamentals.mp4',
                'video_file' => 'videos/css-fundamentals.mp4', // Example path for video file
                'video_embed' => '<iframe src="https://www.youtube.com/embed/example2" frameborder="0" allowfullscreen></iframe>', // Example embed code
                'additional_files' => json_encode([]), // No additional files for this lesson
            ],
        ]);
    }
}
