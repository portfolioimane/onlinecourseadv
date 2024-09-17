@extends('frontend.layouts.app')

@section('title', 'My Enrollments')

@section('content')
    <h1>My Enrollments</h1>
    <div class="row">
        @foreach ($enrollments as $enrollment)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $enrollment->course->thumbnail }}" class="card-img-top" alt="{{ $enrollment->course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $enrollment->course->title }}</h5>
                        <a href="{{ route('frontend.courses.show', $enrollment->course) }}" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
