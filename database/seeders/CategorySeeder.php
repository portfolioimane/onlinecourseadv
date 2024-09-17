<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'Web Development'],
            ['name' => 'Design'],
            ['name' => 'Business'],
            ['name' => 'Marketing'],
            ['name' => 'Photography'],
        ]);
    }
}
