<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Salads & Wraps', 'slug' => 'salad', 'icon' => 'egg-fried'],
            ['name' => 'Sandwiches', 'slug' => 'sandwich', 'icon' => 'stack'],
            ['name' => 'Desserts', 'slug' => 'dessert', 'icon' => 'cup-straw'],
            ['name' => 'Drinks', 'slug' => 'drink', 'icon' => 'cup'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
