<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'content', 'video_url', 'video_file', 'video_embed', 'additional_files'
    ];

    // Cast additional_files to an array when accessing
    protected $casts = [
        'additional_files' => 'array', // Automatically handles JSON to array conversion
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
