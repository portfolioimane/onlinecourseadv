@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Online Courses!</h1>
        <p class="lead">Find the best courses to enhance your skills.</p>
    </div>

    <h2>Featured Courses</h2>
    <div class="row">
        @foreach ($featuredCourses as $course)
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

    <h2>Categories</h2>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <a href="{{ route('frontend.courses.index') }}?category={{ $category->id }}" class="btn btn-primary">View Courses</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
