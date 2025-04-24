<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = [
            'Hot Tea' => ['category' => 'Tea', 'option' => 'Hot'],
            'Iced Tea' => ['category' => 'Tea', 'option' => 'Cold'],
            'Hot Coffee' => ['category' => 'Coffee', 'option' => 'Hot'],
            'Iced Coffee' => ['category' => 'Coffee', 'option' => 'Cold'],
            'Frappe Coffee' => ['category' => 'Coffee', 'option' => 'Frappe'],
        ];

        $data = [];

        foreach ($featuredItems as $featureName => $criteria) {
            $category = Category::where('name', $criteria['category'])->first();
            $option = ItemOption::where('name', $criteria['option'])->first();

            // Only proceed if both category and option are found
            if ($category && $option) {
                $menuItems = MenuItem::where('category_id', $category->id)
                    ->whereHas('itemOptions', function ($query) use ($option) {
                        $query->where('item_option_id', $option->id);
                    })
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

                // Store the fetched items under the feature name
                $data[str_replace(' ', '_', strtolower($featureName))] = $menuItems;
            } else {
                // Handle cases where category or option is not found
                $data[str_replace(' ', '_', strtolower($featureName))] = collect();
            }
        }

        // Pass the data array to the view
        return view('frontend.home.index', $data);
    }
}
