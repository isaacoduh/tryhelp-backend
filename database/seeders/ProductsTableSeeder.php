<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryClothingAccessories = Category::where('slug', 'clothing-and-accessories')->first();
        $categoryHomeKitchen = Category::where('slug','home-and-kitchen')->first();
        $categoryHealthWellness = Category::where('slug','health-and-wellness')->first();
        $categoryPersonalCareBeauty = Category::where('slug', 'personal-care-and-beauty')->first();
        $categoryElectronicsGadgets = Category::where('slug', 'electronics-and-gadgets')->first();
        $categorySustainableFoodBeverages = Category::where('slug', 'sustainable-food-and-beverages')->first();
        $categoryEcoFriendlyCleaningSupplies = Category::where('slug', 'eco-friendly-cleaning-supplies')->first();
        $categoryOutdoorRecreation = Category::where('slug', 'outdoor-and-recreation')->first();
        $categorySustainableBabyKidsProducts = Category::where('slug', 'sustainable-baby-and-kids-products')->first();
        $categoryGreenLivingLifestyle = Category::where('slug', 'green-living-and-lifestyle')->first();

        $categoriesSlugs = [
            'clothing-and-accessories' => [
                    [
                        'name' => 'Organic Cotton Shirts',
                        'description' => 'Organic Cotton shirts, made to perfection'
                    ],
                    [
                        'name' => 'Bamboo socks',
                        'description' => 'Bambo socks, made to last'
                    ],
                    [
                        'name' => 'Hemp backpacks',
                        'description' => 'Created for innovation'
                    ]
                ],
            'home-and-kitchen' => [
                    [
                        'name' => 'Bamboo cutting boards',
                        'description' => ''
                    ],
                    [
                        'name' => 'Reusable food storage bags',
                        'description' => ''
                    ],
                    [
                        'name' => 'Compostable dinnerware',
                        'description' => 'Created for reusability'
                    ],
                ]
            ];
        $productsClothingAccessories = ['Organic Cotton tshirts'];
        $faker = Faker::create();

        foreach ($categoriesSlugs as $slug => $items) {
            $category = Category::where('slug',$slug)->first();
            foreach ($items as $item) {
                Product::create(
                    ['name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $faker->randomFloat(2,1,200),
                    'category_id' => $category->id]
                    );
            }
        }

        // $productList = [
        //     [
        //         'name' => 'Organic Cotton tshirts',
        //         'category_id' => $categoryClothingAccessories->id
        //     ],
        //     [
        //         'name' => 'Bamboo cutting boards',
        //         'category_id' => $categoryHomeKitchen->id
        //     ],
        //     [
        //         'name' => 'Organic Skin Care Products',
        //         'category_id' => $categoryPersonalCareBeauty->id
        //     ],
        //     [
        //         'name' => 'Organic herbal teas',
        //         'category_id' => $categoryHealthWellness->id
        //     ]
        // ];

        // foreach ($productList as $item) {
        //     Product::create($item);
        // }
    }
}
