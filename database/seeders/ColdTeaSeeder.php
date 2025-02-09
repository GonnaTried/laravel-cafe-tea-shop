<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Support\Str;

class ColdTeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $teaCategory = Category::where('name', 'Tea')->first();

        // Fetch item options (assuming they've been seeded)
        $coldOption = ItemOption::where('name', 'Cold')->first();

        $menuItems = [
            [
                'category' => $teaCategory,
                'name' => 'Arnold Palmer',
                'description' => 'A refreshing combination of iced tea and lemonade. The perfect balance of sweet and tart.',
                'ingredients' => 'Iced tea, lemonade, ice.',
                'price' => 4.00,
                'image_path' => 'images/tea/cold/Arnold palmer.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Boba Tea (Bubble Tea)',
                'description' => 'Tea, milk, and tapioca.',
                'ingredients' => 'Milk tea, tapioca, your choice of flavor',
                'price' => 5.00,
                'image_path' => 'images/tea/cold/Iced boba tea.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Iced Green Tea',
                'description' => 'Chilled green tea serve with ice.',
                'ingredients' => 'Green Tea, ice.',
                'price' => 3.00,
                'image_path' => 'images/tea/cold/Iced green tea.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Iced Herbal Tea',
                'description' => 'Brewed herbal teas chilled and served over ice.',
                'ingredients' => 'Brewed herbal tea, ice',
                'price' => 3.00,
                'image_path' => 'images/tea/cold/Iced herbal tea.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Sparkling Iced Tea',
                'description' => 'Our signature tea mix with sparkling water to create a delicious treat.',
                'ingredients' => 'Iced Tea, Sparking water, Fresh fruit',
                'price' => 4.50,
                'image_path' => 'images/tea/cold/Sparkling iced tea.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Sun Tea',
                'description' => 'Tea brewed in the sun.',
                'ingredients' => 'Tea bag, water, sun',
                'price' => 2.00,
                'image_path' => 'images/tea/cold/Sun tea.jpg',
                'options' => [$coldOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Sweet Tea',
                'description' => 'Strongly brewed black tea, sweetened with sugar while hot, and chilled over ice. A classic Southern beverage.',
                'ingredients' => 'Black tea, sugar, water, ice.',
                'price' => 3.50,
                'image_path' => 'images/tea/cold/Sweet tea.jpg',
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
