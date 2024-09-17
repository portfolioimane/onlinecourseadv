@extends('backend.layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lessons</h1>
    
    <!-- Create Lesson Button -->
    <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary mb-3">Create New Lesson</a>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <div class="mb-3">
        <form action="{{ route('admin.lessons.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search lessons..." value="{{ request()->query('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Lessons Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Course</th>
                <th>Title</th>
                <th>Content</th>
                <th>Video</th>
                <th>Additional Files</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->course->title ?? 'N/A' }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ Str::limit(strip_tags($lesson->content), 100) }}</td>

                    <!-- Combined Video Column -->
                    <td>
                        @if ($lesson->video_embed)
                            <!-- Display embedded video -->
                            <div class="video-container">
                                {!! $lesson->video_embed !!}
                            </div>
                        @elseif ($lesson->video_url)
                            <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-link">Watch Video</a>
                        @elseif ($lesson->video_file)
                            <a href="{{ Storage::url($lesson->video_file) }}" target="_blank" class="btn btn-link">View Video</a>
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </td>

                    <!-- Additional Files -->
                    <td>
                        @if ($lesson->additional_files)
                            @php $files = json_decode($lesson->additional_files, true); @endphp
                            @foreach ($files as $file)
                                <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a><br>
                            @endforeach
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td>
                        <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $lessons->links() }}
</div>

<!-- Custom CSS -->
@push('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
        margin-bottom: 1rem; /* Adjust as needed */
    }

    .video-container iframe, .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain aspect ratio and cover container */
    }
</style>
@endpush
@endsection
