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
                'name' => 'Plumber',
                'icon' => 'fas fa-laptop',
            ],
            [
                'name' => 'Smart Home'
            ],
            [
                'name' => 'Painter'
            ],
            [
                'name' => 'Pest Control'
            ],
            [
                'name' => 'Carpenter'
            ],
            [
                'name' => 'Security'
            ],
            [
                'name' => 'Ac Repair'
            ],
            [
                'name' => 'Salon'
            ],
            [
                'name' => 'Barber'
            ],
        ];

        foreach ($parentCategories as $category) {
            Category::create($category);
        }
    }
}
