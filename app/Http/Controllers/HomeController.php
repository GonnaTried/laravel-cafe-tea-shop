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
        // Get the "Coffee" category
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        // Get the "Hot" option
        $hotOption = ItemOption::where('name', 'Hot')->first();

        // Retrieve the first 4 Hot Coffee menu items using a relationship and limiting the result
        $menuItems = MenuItem::where('category_id', $coffeeCategory->id)
            ->whereHas('itemOptions', function ($query) use ($hotOption) {
                $query->where('item_option_id', $hotOption->id);
            })
            ->limit(4)
            ->get();

        return view('frontend.home.index', compact('menuItems'));
    }
}
