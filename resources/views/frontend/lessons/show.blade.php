@extends('frontend.layouts.app')

@section('title', $lesson->title)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Lesson Header -->
                <header class="text-center mb-4">
                    <h1 class="display-4">{{ $lesson->title }}</h1>
                    <p class="lead">{{ $lesson->content }}</p>
                </header>

                <!-- Video Section -->
                @php
                    $videoSrc = $lesson->video_url;
                    $isYouTubeURL = strpos($videoSrc, 'youtube.com') !== false || strpos($videoSrc, 'youtu.be') !== false;
                @endphp

                @if($lesson->video_embed)
                    <div class="video-container mb-4">
                        <!-- Display embedded video -->
                        {!! $lesson->video_embed !!}
                    </div>
                @elseif($isYouTubeURL)
                    <div class="video-container mb-4">
                        <!-- Convert YouTube URL to embed URL -->
                        @php
                            $videoId = null;
                            if (strpos($videoSrc, 'youtu.be') !== false) {
                                $videoId = basename(parse_url($videoSrc, PHP_URL_PATH));
                            } elseif (strpos($videoSrc, 'youtube.com') !== false) {
                                parse_str(parse_url($videoSrc, PHP_URL_QUERY), $query);
                                $videoId = $query['v'] ?? null;
                            }
                            $embedSrc = $videoId ? "https://www.youtube.com/embed/$videoId" : $videoSrc;
                        @endphp
                        <iframe width="560" height="315" src="{{ $embedSrc }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @elseif($videoSrc)
                    <div class="video-container mb-4">
                        <video controls class="img-fluid">
                            <source src="{{ $videoSrc }}" type="video/mp4">
                            <!-- Add alternative video formats if available -->
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif

                <!-- Additional Files Section -->
                @if(count($additionalFiles) > 0)
                    <div class="additional-files mb-4">
                        <h4 class="mb-3">Additional Files:</h4>
                        <ul class="list-group">
                            @foreach($additionalFiles as $file)
                                <li class="list-group-item">
                                    <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Navigation Links -->
                <div class="d-flex justify-content-between mt-4">
                    @if($previousLesson)
                        <a href="{{ route('frontend.lessons.show', ['course' => $course->id, 'lesson' => $previousLesson->id]) }}" class="btn btn-secondary">Previous Lesson</a>
                    @endif

                    @if($nextLesson)
                        <a href="{{ route('frontend.lessons.show', ['course' => $course->id, 'lesson' => $nextLesson->id]) }}" class="btn btn-secondary">Next Lesson</a>
                    @endif
                </div>
            </div>
        </div>
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

        .additional-files ul {
            padding-left: 0;
            list-style: none;
        }

        .additional-files li {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
            padding: 10px;
            background: #f9f9f9;
        }
    </style>
    @endpush
@endsection
