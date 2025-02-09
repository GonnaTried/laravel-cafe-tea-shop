<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    public function index()
    {
        // Get the "Coffee" category
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        // Get the "Hot" Option
        $hotOption = ItemOption::where('name', 'Hot')->first();
        // Get the "Cold" Option
        $coldOption = ItemOption::where('name', 'Cold')->first();
        // Get the "Frappe" Option
        $frappeOption = ItemOption::where('name', 'Frappe')->first();

        // Retrieve Hot Coffees
        $hotCoffees = MenuItem::where('category_id', $coffeeCategory->id)
            ->whereHas('itemOptions', function ($query) use ($hotOption) {
                $query->where('item_option_id', $hotOption->id);
            })
            ->get();

        // Retrieve Cold Coffees
        $coldCoffees = MenuItem::where('category_id', $coffeeCategory->id)
            ->whereHas('itemOptions', function ($query) use ($coldOption) {
                $query->where('item_option_id', $coldOption->id);
            })
            ->get();

        // Retrieve Frappe Coffees
        $frappeCoffees = MenuItem::where('category_id', $coffeeCategory->id)
            ->whereHas('itemOptions', function ($query) use ($frappeOption) {
                $query->where('item_option_id', $frappeOption->id);
            })
            ->get();
        // For each section get an id
        return view('frontend.coffee.index', compact('hotCoffees', 'coldCoffees', 'frappeCoffees'));
    }
}
