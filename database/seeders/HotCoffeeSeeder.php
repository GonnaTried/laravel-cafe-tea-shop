<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Support\Str;

class HotCoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        // Fetch item options
        $hotOption = ItemOption::where('name', 'Hot')->first();

        $menuItems = [
            [
                'name' => 'Classic Drip Coffee',
                'description' => 'Brewed fresh throughout the day using ethically sourced, medium-roast Arabica beans. Expect a balanced cup with notes of [mention flavor notes: e.g., caramel, chocolate, nutty]. Smooth and comforting.',
                'ingredients' => 'Filtered water, medium-roast Arabica coffee beans.',
                'price' => 2.50,
                'image_path' => 'images/coffees/hot/Classic Drip Coffee.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Espresso',
                'description' => 'A concentrated shot of intense flavor. Dark roasted beans are finely ground and brewed under pressure, resulting in a rich, slightly bitter, and aromatic experience. A foundation for many of our other coffee drinks.',
                'ingredients' => 'Finely ground dark roast Arabica coffee beans, filtered water.',
                'price' => 2.00,
                'image_path' => 'images/coffees/hot/Espresso.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Americano',
                'description' => 'The boldness of espresso softened with hot water. Offers a longer, milder coffee experience while retaining the espresso\'s signature crema and flavor profile.',
                'ingredients' => 'Espresso, hot filtered water.',
                'price' => 3.00,
                'image_path' => 'images/coffees/hot/Americano.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'A perfectly balanced Italian classic. One-third espresso, one-third steamed milk, and one-third frothy milk create a delightful textural contrast and a harmonious blend of coffee and dairy.',
                'ingredients' => 'Espresso, steamed whole milk (alternative milk options available), foamed whole milk (alternative milk options available).',
                'price' => 4.00,
                'image_path' => 'images/coffees/hot/Cappuccino.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Latte',
                'description' => 'Espresso artfully combined with steamed milk, creating a smooth and creamy texture. The gentle coffee flavor is enhanced by the sweetness of the milk. Choose your flavor addition: Vanilla, Caramel, Hazelnut',
                'ingredients' => 'Espresso, steamed whole milk (alternative milk options available).',
                'price' => 4.00,
                'image_path' => 'images/coffees/hot/Latte.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Mocha',
                'description' => 'A decadent treat blending rich espresso with a sweet chocolate sauce. Topped with steamed milk for a smooth, indulgent drink. Whipped cream adds an extra touch of luxury (optional).',
                'ingredients' => 'Espresso, chocolate syrup (containing cocoa, sugar, and vanilla extract), steamed whole milk (alternative milk options available), whipped cream (optional - containing heavy cream, sugar, and vanilla extract).',
                'price' => 4.50,
                'image_path' => 'images/coffees/hot/Mocha.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Caramel Macchiato',
                'description' => 'Layers of sweet vanilla syrup, steamed milk, and espresso, drizzled with a ribbon of buttery caramel. The espresso slowly blends into the milk for a gradual release of coffee flavor.',
                'ingredients' => 'Vanilla syrup (containing sugar, water, and vanilla extract), steamed whole milk (alternative milk options available), espresso, caramel drizzle (containing sugar, butter, cream, and vanilla extract).',
                'price' => 5.00,
                'image_path' => 'images/coffees/hot/Caramel Macchiato.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Cafe au Lait',
                'description' => 'A French classic featuring equal parts rich, freshly brewed coffee and warm, steamed milk. A comforting and balanced drink, perfect for a leisurely morning.',
                'ingredients' => 'Drip coffee, steamed whole milk (alternative milk options available).',
                'price' => 3.50,
                'image_path' => 'images/coffees/hot/Cafe au Lait.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Honey Lavender Latte',
                'description' => 'A fragrant and calming latte infused with the delicate floral aroma of lavender and the natural sweetness of honey. A touch of elegance in every sip.',
                'ingredients' => 'Espresso, steamed whole milk (alternative milk options available), lavender syrup (containing water, sugar, natural lavender extract), honey.',
                'price' => 5.50,
                'image_path' => 'images/coffees/hot/Honey Lavender Latte.jpg',
                'options' => [$hotOption],
            ],
            [
                'name' => 'Spiced Pumpkin Latte (Seasonal)',
                'description' => 'Embrace the flavors of fall with our seasonal pumpkin spice latte. Rich espresso is combined with a blend of pumpkin puree, warming spices, and steamed milk. Topped with whipped cream and a sprinkle of pumpkin pie spice.',
                'ingredients' => 'Espresso, pumpkin spice syrup (containing pumpkin puree, sugar, cinnamon, ginger, nutmeg, cloves), steamed whole milk (alternative milk options available), whipped cream (containing heavy cream, sugar, and vanilla extract), pumpkin pie spice (containing cinnamon, ginger, nutmeg, cloves).',
                'price' => 6.00,
                'image_path' => 'images/coffees/hot/Spiced Pumpkin Latte.jpg',
                'options' => [$hotOption],
            ],
        ];

        foreach ($menuItems as $itemData) {
            $menuItem = MenuItem::create([
                'category_id' => $coffeeCategory->id,
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
