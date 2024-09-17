@extends('frontend.layouts.app')

@section('title', 'Courses')

@section('content')
    <h1>Courses</h1>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $course->thumbnail }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('frontend.courses.show', $course) }}" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
