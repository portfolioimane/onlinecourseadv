@extends('backend.layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Courses
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalCourses }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Lessons
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalLessons }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Enrollments
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalEnrollments }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
