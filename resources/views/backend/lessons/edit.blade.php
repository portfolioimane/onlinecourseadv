@extends('backend.layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Lesson</h1>

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

    <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_id">Course</label>
            <select id="course_id" name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $lesson->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $lesson->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Video Option Selection -->
        <div class="form-group">
            <label>Select Video Option</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="video_option" id="video_option_url" value="url" {{ $lesson->video_url && !$lesson->video_embed && !$lesson->video_file ? 'checked' : '' }}>
                <label class="form-check-label" for="video_option_url">
                    Video URL
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="video_option" id="video_option_embed" value="embed" {{ $lesson->video_embed ? 'checked' : '' }}>
                <label class="form-check-label" for="video_option_embed">
                    Embed Code(YouTube, Vimeo, Bunny.net, etc.)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="video_option" id="video_option_upload" value="upload" {{ $lesson->video_file ? 'checked' : '' }}>
                <label class="form-check-label" for="video_option_upload">
                    Upload Video
                </label>
            </div>
        </div>

        <!-- Video URL Input -->
        <div class="form-group" id="video_url_group">
            <label for="video_url">Video URL</label>
            <input type="text" id="video_url" name="video_url" class="form-control" value="{{ old('video_url', $lesson->video_url) }}">
            @error('video_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Video Embed Code Input -->
        <div class="form-group d-none" id="video_embed_group">
            <label for="video_embed">Embed Code</label>
            <textarea id="video_embed" name="video_embed" class="form-control" rows="3">{{ old('video_embed', $lesson->video_embed) }}</textarea>
            @error('video_embed')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Video File Upload -->
        <div class="form-group d-none" id="video_file_group">
            <label for="video_file">Upload Video</label>
            <input type="file" id="video_file" name="video_file" class="form-control-file" accept="video/*">
            <small class="form-text text-muted">Current video: {{ $lesson->video_file ? basename($lesson->video_file) : 'None' }}</small>
        </div>

        <div class="form-group">
            <label for="additional_files">Upload Additional Files (Optional)</label>
            <input type="file" id="additional_files" name="additional_files[]" class="form-control-file" multiple>
            <small class="form-text text-muted">Current files: 
                @if ($lesson->additional_files)
                    @foreach (json_decode($lesson->additional_files, true) as $file)
                        <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a><br>
                    @endforeach
                @else
                    None
                @endif
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor for rich text content
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });

    // Video option selection logic
    $(document).ready(function() {
        // Show/hide video input fields based on selected option
        $('input[name="video_option"]').on('change', function() {
            if ($('#video_option_url').is(':checked')) {
                $('#video_url_group').removeClass('d-none');
                $('#video_embed_group').addClass('d-none');
                $('#video_file_group').addClass('d-none');
            } else if ($('#video_option_embed').is(':checked')) {
                $('#video_url_group').addClass('d-none');
                $('#video_embed_group').removeClass('d-none');
                $('#video_file_group').addClass('d-none');
            } else {
                $('#video_url_group').addClass('d-none');
                $('#video_embed_group').addClass('d-none');
                $('#video_file_group').removeClass('d-none');
            }
        });

        // Trigger change event on page load to set the correct initial state
        $('input[name="video_option"]:checked').trigger('change');
    });
</script>
@endpush
