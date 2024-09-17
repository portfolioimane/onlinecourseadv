@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Categories</h1>
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
</div>
@endsection
