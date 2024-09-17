@extends('backend.layouts.admin')

@section('content')
<div class="container">
    <h1>Courses</h1>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Create Course</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->category->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $courses->links() }}
</div>
@endsection
