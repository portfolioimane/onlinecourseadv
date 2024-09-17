@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')
    <h1>{{ $user->name }}</h1>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <a href="{{ route('frontend.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
@endsection
