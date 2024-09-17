@extends('frontend.layouts.app')

@section('title', $course->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $course->title }}</h1>
                <img src="{{ $course->thumbnail }}" class="img-fluid mb-4" alt="{{ $course->title }}">
                <p>{{ $course->description }}</p>
                <p><strong>Price: </strong>{{ $course->price }} MAD</p>

                @if($lessons->count())
                    <h2 class="mt-4">Course Lessons</h2>
                    <ul class="list-group mt-2">
                        @foreach ($lessons as $lesson)
                            <li class="list-group-item">
                                <h5>{{ $lesson->title }}</h5>
                                <p>{{ $lesson->content }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No lessons available for this course.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
