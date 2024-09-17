@extends('backend.layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Create Lesson</h1>

    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="lessonForm" action="{{ route('admin.lessons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="course_id">Course</label>
            <select id="course_id" name="course_id" class="form-control" required>
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
        </div>

        <!-- Video Selection Option -->
        <div class="form-group">
            <label>Select Video Option</label>
            <div class="form-check">
                <input type="radio" id="video_option_url" name="video_option" value="url" class="form-check-input" checked>
                <label for="video_option_url" class="form-check-label">Video URL</label>
            </div>
            <div class="form-check">
                <input type="radio" id="video_option_embed" name="video_option" value="embed" class="form-check-input">
                <label for="video_option_embed" class="form-check-label">Embed Code (YouTube, Vimeo, Bunny.net, etc.)</label>
            </div>
            <div class="form-check">
                <input type="radio" id="video_option_upload" name="video_option" value="upload" class="form-check-input">
                <label for="video_option_upload" class="form-check-label">Upload Video</label>
            </div>
        </div>

        <!-- Video URL Input -->
        <div class="form-group" id="video_url_group">
            <label for="video_url">Video URL (Optional)</label>
            <input type="text" id="video_url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="Enter video URL (e.g., YouTube or Vimeo)">
        </div>

        <!-- Video Embed Code Input -->
        <div class="form-group d-none" id="video_embed_group">
            <label for="video_embed">Embed Code (Optional)</label>
            <textarea id="video_embed" name="video_embed" class="form-control" rows="3" placeholder="Enter embed code (e.g., YouTube iframe)">{{ old('video_embed') }}</textarea>
        </div>

        <!-- Video File Upload Input -->
        <div class="form-group d-none" id="video_file_group">
            <label for="video_file">Upload Video (Optional)</label>
            <input type="file" id="video_file" name="video_file" class="form-control-file" accept="video/*">
        </div>

        <div class="form-group">
            <label for="additional_files">Upload Additional Files (Optional)</label>
            <input type="file" id="additional_files" name="additional_files[]" class="form-control-file" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Save Lesson</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoOptionUrl = document.getElementById('video_option_url');
    const videoOptionEmbed = document.getElementById('video_option_embed');
    const videoOptionUpload = document.getElementById('video_option_upload');
    const videoUrlGroup = document.getElementById('video_url_group');
    const videoEmbedGroup = document.getElementById('video_embed_group');
    const videoFileGroup = document.getElementById('video_file_group');

    function updateVideoOptions() {
        if (videoOptionUrl.checked) {
            videoUrlGroup.classList.remove('d-none');
            videoEmbedGroup.classList.add('d-none');
            videoFileGroup.classList.add('d-none');
        } else if (videoOptionEmbed.checked) {
            videoUrlGroup.classList.add('d-none');
            videoEmbedGroup.classList.remove('d-none');
            videoFileGroup.classList.add('d-none');
        } else {
            videoUrlGroup.classList.add('d-none');
            videoEmbedGroup.classList.add('d-none');
            videoFileGroup.classList.remove('d-none');
        }
    }

    videoOptionUrl.addEventListener('change', updateVideoOptions);
    videoOptionEmbed.addEventListener('change', updateVideoOptions);
    videoOptionUpload.addEventListener('change', updateVideoOptions);
});
</script>
@endsection
