<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Support\Str;

class ColdCoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        // Fetch item options
        $coldOption = ItemOption::where('name', 'Cold')->first();

        $menuItems = [
            [
                'category' => $coffeeCategory,
                'name' => 'Cold Brew',
                'description' => 'Our cold brew coffee is steeped for 20 hours for a low acidity brew.',
                'ingredients' => 'Coarsely ground coffee beans, filtered water',
                'price' => 4.00,
                'image_path' => 'images/coffees/cold/Cold brew.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Espresso Tonic',
                'description' => 'A unexpected combination that will delight your taste buds',
                'ingredients' => 'Espresso, Tonic water, Lime',
                'price' => 6.00,
                'image_path' => 'images/coffees/cold/Espresso tonic.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Iced Mocha',
                'description' => 'A chocolate lover\'s dream! Espresso, chocolate syrup, and cold milk are combined over ice for a refreshing and indulgent treat. Top with whipped cream for extra decadence (optional).',
                'ingredients' => 'Espresso, chocolate syrup (containing cocoa, sugar, and vanilla extract), cold whole milk (alternative milk options available), ice, whipped cream (optional - containing heavy cream, sugar, and vanilla extract).',
                'price' => 5.00,
                'image_path' => 'images/coffees/cold/Ice mocha.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Iced Americano',
                'description' => 'The boldness of espresso with a refreshing chill. Espresso is poured over cold water and ice, creating a crisp and invigorating coffee drink.',
                'ingredients' => 'Espresso, cold water, ice.',
                'price' => 3.50,
                'image_path' => 'images/coffees/cold/Iced Americano.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Iced Coffee',
                'description' => 'Our signature drip coffee, chilled to perfection and served over ice. Enjoy the same smooth, balanced flavor with a refreshing twist.',
                'ingredients' => 'Brewed coffee, ice.',
                'price' => 3.00,
                'image_path' => 'images/coffees/cold/Iced coffee.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Iced Latte',
                'description' => 'The classic latte, served over ice. Rich espresso is swirled with cold milk, creating a smooth and refreshing coffee experience. Choose your flavor addition: Vanilla, Caramel, Hazelnut',
                'ingredients' => 'Espresso, cold whole milk (alternative milk options available), ice.',
                'price' => 4.50,
                'image_path' => 'images/coffees/cold/Iced latte.jpg',
                'options' => [$coldOption],
            ],

        ];

        foreach ($menuItems as $itemData) {
            $menuItem = MenuItem::create([
                'category_id' => $itemData['category']->id,
                'name' => $itemData['name'],
                'slug' => Str::slug($itemData['name']),
                'description' => $itemData['description'],
                'ingredients' => $itemData['ingredients'],
                'price' => $itemData['price'],
                'image_path' => $itemData['image_path'],
            ]);

            // Attach item options
            if (isset($itemData['options']) && is_array($itemData['options'])) {
                $menuItem->itemOptions()->attach(
                    collect($itemData['options'])->pluck('id')->toArray()
                );
            }
        }
    }
}
