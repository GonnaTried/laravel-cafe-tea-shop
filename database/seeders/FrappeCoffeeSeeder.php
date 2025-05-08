<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Support\Str;

class FrappeCoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        // Fetch item options
        $frappeOption = ItemOption::where('name', 'Frappe')->first(); // Assuming you have "Frappe" as an option

        $menuItems = [
            [
                'category' => $coffeeCategory,
                'name' => 'Classic Coffee Frappe',
                'description' => 'A classic, no-nonsense coffee frappe. We blend rich espresso with milk, a touch of sweetness, and plenty of ice for a perfectly chilled and energizing treat. A simple but effective pick-me-up.',
                'ingredients' => 'Espresso, milk (whole, skim, almond, soy, or oat), ice, simple syrup (or sugar), optional whipped cream topping.',
                'price' => 4.50,
                'image_path' => 'images/coffees/frappe/Classic coffee frappe.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Mocha Frappe',
                'description' => 'A chocolate lover\'s dream! We blend our signature espresso with rich chocolate sauce, creamy milk, and ice for an irresistible combination. Topped with whipped cream and a dusting of cocoa powder for an extra touch of indulgence.',
                'ingredients' => 'Espresso, chocolate sauce (containing cocoa, sugar, vanilla), milk (whole, skim, almond, soy, or oat), ice, optional whipped cream topping, cocoa powder dusting.',
                'price' => 5.00,
                'image_path' => 'images/coffees/frappe/Mocha frappe.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Caramel Frappe',
                'description' => 'A deliciously sweet and creamy frappe with layers of caramel flavor. We blend espresso with caramel syrup, milk, and ice, then top it off with whipped cream and a generous drizzle of caramel sauce.',
                'ingredients' => 'Espresso, caramel syrup (containing sugar, butter, vanilla), milk (whole, skim, almond, soy, or oat), ice, optional whipped cream topping, caramel drizzle.',
                'price' => 5.00,
                'image_path' => 'images/coffees/frappe/Caramel frappe copy.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Vanilla Bean Frappe',
                'description' => 'A smooth and aromatic frappe infused with the delicate flavor of real vanilla bean. We blend espresso with vanilla bean paste, milk, and ice for a subtle sweetness that\'s both refreshing and satisfying.',
                'ingredients' => 'Espresso, vanilla bean paste (containing vanilla extract, vanilla bean seeds, sugar), milk (whole, skim, almond, soy, or oat), ice, optional whipped cream topping.',
                'price' => 5.00,
                'image_path' => 'images/coffees/frappe/Vanilla bean frappe.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Mint Chocolate Chip Frappe',
                'description' => 'A refreshing and invigorating frappe with a cool minty twist. We blend espresso with mint syrup, chocolate chips, milk, and ice for a delicious combination of coffee, chocolate, and mint.',
                'ingredients' => 'Espresso, mint syrup (containing sugar, mint extract), chocolate chips, milk (whole, skim, almond, soy, or oat), ice, optional whipped cream topping.',
                'price' => 5.25,
                'image_path' => 'images/coffees/frappe/Mint chocolate chip frappe.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Cookies and Cream Frappe',
                'description' => 'For a more substantial treat. We combine espresso with Oreo cookies, milk, and ice for a decadent and playful frappe that\'s sure to satisfy your sweet tooth. Topped with whipped cream and cookie crumbles.',
                'ingredients' => 'Espresso, Oreo cookies, milk (whole, skim, almond, soy, or oat), ice, optional whipped cream topping, Oreo cookie crumbles.',
                'price' => 5.50,
                'image_path' => 'images/coffees/frappe/Cookie and cream frappe.jpg',
                'options' => [$frappeOption],
            ],
            [
                'category' => $coffeeCategory,
                'name' => 'Coffee Banana Frappe',
                'description' => 'For a more healthy treat. We combine espresso, banana, milk, and ice for a decadent and playful frappe that\'s sure to satisfy your hunger. Topped with whipped cream and chocolate drizzle.',
                'ingredients' => 'Espresso, milk (whole, skim, almond, soy, or oat), ice, banana, chocolate drizzle.',
                'price' => 5.50,
                'image_path' => 'images/coffees/frappe/Coffee banana frappe.jpg',
                'options' => [$frappeOption],
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
                'inventory' => 100, // <--- Added this line
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
