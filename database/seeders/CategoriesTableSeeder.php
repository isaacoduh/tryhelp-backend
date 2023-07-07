<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        
        $parentCategories = [
            [
                'name' => 'Clothing and Accessories',
                'icon' => 'fas fa-laptop',
            ],
            [
                'name' => 'Home and Kitchen'
            ],
            [
                'name' => 'Health and Wellness'
            ],
            [
                'name' => 'Personal Care and Beauty'
            ],
            [
                'name' => 'Electronics and Gadgets'
            ],
            [
                'name' => 'Sustainable Food and Beverages'
            ],
            [
                'name' => 'Eco-friendly Cleaning Supplies'
            ],
            [
                'name' => 'Outdoor and Recreation'
            ],
            [
                'name' => 'Sustainable Baby and Kids Products'
            ],
            [
                'name' => 'Green Living and Lifestyle'
            ],
        ];

        foreach ($parentCategories as $category) {
            Category::create($category);
        }
    }
}
