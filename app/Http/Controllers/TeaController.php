<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\ItemOption;
use Illuminate\Http\Request;

class TeaController extends Controller
{
    public function index()
    {
        // Get the "Tea" category
        $teaCategory = Category::where('name', 'Tea')->firstOrFail();

        // Get the "Hot" and "Cold" options
        $hotOption = ItemOption::where('name', 'Hot')->first();
        $coldOption = ItemOption::where('name', 'Cold')->first();

        // Retrieve Hot Teas
        $hotTeas = MenuItem::where('category_id', $teaCategory->id)
            ->whereHas('itemOptions', function ($query) use ($hotOption) {
                $query->where('item_option_id', $hotOption->id);
            })
            ->get();

        // Retrieve Iced Teas
        $icedTeas = MenuItem::where('category_id', $teaCategory->id)
            ->whereHas('itemOptions', function ($query) use ($coldOption) {
                $query->where('item_option_id', $coldOption->id);
            })
            ->get();

        return view('frontend.tea.index', compact('hotTeas', 'icedTeas'));
    }
}
