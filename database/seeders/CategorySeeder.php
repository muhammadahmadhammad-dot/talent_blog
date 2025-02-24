<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'=>'Educational',
                'slug'=>'educational',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Tech & IT or AI',
                'slug'=>'tech-&-it-or-ai',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Plantation',
                'slug'=>'plantation',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];
        Category::create($categories);
    }
}
