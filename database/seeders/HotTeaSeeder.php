<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Support\Str;

class HotTeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $teaCategory = Category::where('name', 'Tea')->first();

        // Fetch item options (assuming they've been seeded)
        $hotOption = ItemOption::where('name', 'Hot')->first();
        $menuItems = [
            [
                'category' => $teaCategory,
                'name' => 'Earl Grey',
                'description' => 'A fragrant black tea infused with the oil of bergamot orange. The citrusy aroma and flavor create a refreshing and uplifting experience.',
                'ingredients' => 'Black tea leaves, bergamot oil.',
                'price' => 3.50,
                'image_path' => 'images/tea/hot/Earl grey tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Darjeeling',
                'description' => 'A delicate and aromatic black tea from the Darjeeling region of India. Known for its light, floral, and slightly muscatel notes.',
                'ingredients' => 'Darjeeling black tea leaves.',
                'price' => 4.00,
                'image_path' => 'images/tea/hot/Darjeeling tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Masala Chai',
                'description' => 'A comforting and aromatic blend of black tea, milk, and warming spices. Expect a rich and creamy texture with notes of cardamom, cinnamon, ginger, cloves, and black pepper.',
                'ingredients' => 'Black tea leaves, whole milk (alternative milk options available), water, cardamom pods, cinnamon stick, ginger, cloves, black peppercorns, sugar or honey (optional).',
                'price' => 4.50,
                'image_path' => 'images/tea/hot/Masala chai.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Sencha',
                'description' => 'A classic Japanese green tea with a refreshing vegetal flavor and a hint of sweetness. The vibrant green leaves create a bright and invigorating cup.',
                'ingredients' => 'Sencha green tea leaves.',
                'price' => 3.50,
                'image_path' => 'images/tea/hot/Sencha tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Matcha',
                'description' => 'Finely ground green tea.',
                'ingredients' => 'Matcha powder, hot water',
                'price' => 5.00,
                'image_path' => 'images/tea/hot/Matcha.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Jasmine Green Tea',
                'description' => 'Green tea leaves carefully layered with jasmine blossoms to absorb their delicate fragrance. The result is a fragrant and refreshing tea with a subtly sweet and floral flavor.',
                'ingredients' => 'Green tea leaves, jasmine blossoms.',
                'price' => 4.00,
                'image_path' => 'images/tea/hot/Jasmine green tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'White Peony',
                'description' => 'A rare and delicate white tea made from young tea buds and leaves. Expect a subtle sweetness, a hint of floral notes, and a smooth, velvety texture.',
                'ingredients' => 'White tea leaves.',
                'price' => 6.00,
                'image_path' => 'images/tea/hot/White peony tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Tieguanyin (Iron Goddess)',
                'description' => 'A complex and flavorful oolong tea from China. Depending on the level of oxidation, expect notes ranging from floral and fruity to roasted and nutty.',
                'ingredients' => 'Oolong tea leaves.',
                'price' => 5.50,
                'image_path' => 'images/tea/hot/Tieguanyin tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Chamomile',
                'description' => 'A naturally caffeine-free herbal infusion made from dried chamomile flowers. Known for its calming and relaxing properties, with a delicate floral aroma and a slightly sweet, apple-like flavor.',
                'ingredients' => 'Dried chamomile flowers.',
                'price' => 3.00,
                'image_path' => 'images/tea/hot/Chamomile tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Peppermint',
                'description' => 'A naturally caffeine-free herbal infusion made from peppermint leaves. Known for its refreshing and digestive properties, with a cool, minty aroma and flavor.',
                'ingredients' => 'Dried peppermint leaves.',
                'price' => 3.00,
                'image_path' => 'images/tea/hot/Peppermint tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Ginger',
                'description' => 'A naturally caffeine-free herbal infusion made from ginger root. Expect a spicy and warming flavor thats both invigorating and soothing.',
                'ingredients' => 'Fresh ginger root.',
                'price' => 3.50,
                'image_path' => 'images/tea/hot/Ginger tea.jpg',
                'options' => [$hotOption],
            ],
            [
                'category' => $teaCategory,
                'name' => 'Rooibos',
                'description' => 'A naturally caffeine-free herbal infusion from South Africa. Known for its reddish-brown color and naturally sweet, slightly nutty flavor.',
                'ingredients' => 'Rooibos leaves.',
                'price' => 3.50,
                'image_path' => 'images/tea/hot/Rooibos tea.jpg',
                'options' => [$hotOption],
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
                'inventory' => 100, // <-- Added this line with a default value
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
