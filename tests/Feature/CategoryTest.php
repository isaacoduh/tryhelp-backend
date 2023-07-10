<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void 
    {
        parent::setUp();
        $categories = [
            [
                'name' => 'cleaner'
            ],
            [
                'name' => 'window wash'
            ],
            [
                'name' => 'salon'
            ],
            [
                'name' => 'barber'
            ],
            [
                'name' => 'ac repair'
            ],
            [
                'name' => 'tailor'
            ]
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
    
    public function testCategoriesCanBeFilteredByLimit()
    {
        // $response = $this->json('GET', route('api.categories.all'));
        $response = $this->get('/api/categories?limit=3');
        $response->assertStatus(200);
        $response->assertJsonCount(3,'data');
    }

    public function testCategoriesListDefaultToFiveWhenNoLimitProvided()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
