<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// app/Models/User.php
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define roles
    const ROLE_STUDENT = 'student';
    const ROLE_INSTRUCTOR = 'instructor';

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define relationships
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}

