<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class ViewItemController extends Controller
{
    public function index(string $slug)
    {
        $menuItem = MenuItem::where('slug', $slug)->firstOrFail();

        return view('frontend.viewItem.index', compact('menuItem'));
    }
}
