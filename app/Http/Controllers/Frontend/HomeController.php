<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::latest()->take(5)->get();
        $categories = Category::all();
        return view('frontend.home', compact('featuredCourses', 'categories')); // Create view in resources/views/frontend/home.blade.php
    }
}
