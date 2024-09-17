<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('course')->latest()->paginate(10);
        return view('backend.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('backend.lessons.create', compact('courses'));
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('backend.lessons.edit', compact('lesson', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_option' => 'required|in:url,embed,upload',
            'video_url' => 'nullable|string|required_if:video_option,url',
            'video_embed' => 'nullable|string|required_if:video_option,embed',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov|max:10000|required_if:video_option,upload',
            'additional_files.*' => 'nullable|file|mimes:pdf,docx,zip|max:5000',
        ]);

        $videoPath = null;
        $videoUrl = null;
        $videoEmbed = null;

        if ($request->video_option === 'url') {
            $videoUrl = $request->video_url;
        } elseif ($request->video_option === 'embed') {
            $videoEmbed = $request->video_embed;
        } elseif ($request->video_option === 'upload' && $request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoPath = $video->store('videos', 'public');
        }

        $additionalFiles = [];
        if ($request->hasFile('additional_files')) {
            foreach ($request->file('additional_files') as $file) {
                $filePath = $file->store('additional_files', 'public');
                $additionalFiles[] = $filePath;
            }
        }

        Lesson::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $videoUrl,
            'video_embed' => $videoEmbed,
            'video_file' => $videoPath,
            'additional_files' => json_encode($additionalFiles),
        ]);

        return redirect()->route('admin.lessons.index')->with('success', 'Lesson created successfully.');
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_option' => 'required|in:url,embed,upload',
            'video_url' => 'nullable|string|required_if:video_option,url',
            'video_embed' => 'nullable|string|required_if:video_option,embed',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov|max:10000|required_if:video_option,upload',
            'additional_files.*' => 'nullable|file|mimes:pdf,docx,zip|max:5000',
        ]);

        $videoPath = $lesson->video_file;
        $videoUrl = $lesson->video_url;
        $videoEmbed = $lesson->video_embed;

        if ($request->video_option === 'url') {
            $videoUrl = $request->video_url;
            $videoEmbed = null;
            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
                $videoPath = null;
            }
        } elseif ($request->video_option === 'embed') {
            $videoEmbed = $request->video_embed;
            $videoUrl = null;
            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
                $videoPath = null;
            }
        } elseif ($request->video_option === 'upload' && $request->hasFile('video_file')) {
            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
            }
            $video = $request->file('video_file');
            $videoPath = $video->store('videos', 'public');
            $videoUrl = null;
            $videoEmbed = null;
        }

        $additionalFiles = json_decode($lesson->additional_files, true) ?: [];
        if ($request->hasFile('additional_files')) {
            foreach ($request->file('additional_files') as $file) {
                $filePath = $file->store('additional_files', 'public');
                $additionalFiles[] = $filePath;
            }
        }

        $lesson->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $videoUrl,
            'video_embed' => $videoEmbed,
            'video_file' => $videoPath,
            'additional_files' => json_encode($additionalFiles),
        ]);

        return redirect()->route('admin.lessons.index')->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        if ($lesson->video_file) {
            Storage::disk('public')->delete($lesson->video_file);
        }

        $additionalFiles = json_decode($lesson->additional_files, true) ?: [];
        foreach ($additionalFiles as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        $lesson->delete();
        return redirect()->route('admin.lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
