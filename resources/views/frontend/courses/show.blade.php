@extends('frontend.layouts.app')

@section('title', $course->title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $course->title }}</h1>
            <img src="{{ $course->thumbnail }}" class="img-fluid mb-4" alt="{{ $course->title }}">
            <p>{{ $course->description }}</p>
            <p><strong>Price: </strong>{{ $course->price }} MAD</p>

            @auth
                @php
                    $isEnrolled = Auth::user()->enrollments()->where('course_id', $course->id)->exists();
                @endphp

                @if($isEnrolled)
                    <h2 class="mt-4">Course Lessons</h2>
                    @if($lessons->count())
                        <ul class="list-group mt-2">
                            @foreach ($lessons as $lesson)
                                <li class="list-group-item">
                                    <a href="{{ route('frontend.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}">
                                        <h5>{{ $lesson->title }}</h5>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No lessons available for this course.</p>
                    @endif
                @else
                    <form action="{{ route('frontend.courses.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Enroll Now</button>
                    </form>
                @endif
            @else
                <p><a href="{{ route('login') }}" class="btn btn-primary">Login to Enroll</a></p>
            @endauth
        </div>
    </div>
@endsection
