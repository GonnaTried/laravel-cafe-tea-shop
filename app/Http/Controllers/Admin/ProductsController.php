<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ItemOption;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index()
    {
        $products = MenuItem::orderBy('id')->paginate(30); // Fetch products, order by name, add pagination

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        $itemOptions = ItemOption::all(); // Fetch all item options

        // Pass both to the view
        return view('admin.products.create', compact('categories', 'itemOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'inventory' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
            // Validation for the single selected option (required now)
            'selected_option_id' => 'required|exists:item_options,id',
            // Removed 'price_adjustment' validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_item_images', 'public');
        }

        $product = MenuItem::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'image_path' => $imagePath,
        ]);


        $selectedOptionId = $request->input('selected_option_id');

        // Use attach with just the ID
        $product->itemOptions()->attach($selectedOptionId);


        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show(MenuItem $product) // Route model binding automatically fetches the product
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(MenuItem $product)
    {
        $categories = Category::all(); // Fetch all categories
        $itemOptions = ItemOption::all(); // Fetch all item options

        // Fetch the options currently attached to the product with their pivot data
        $currentOptions = $product->itemOptions->keyBy('id'); // Key by ID for easy lookup

        // Pass all necessary data to the view
        return view('admin.products.edit', compact('product', 'categories', 'itemOptions', 'currentOptions'));
    }

    public function update(Request $request, MenuItem $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'inventory' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
            // Validation for the single selected option (required now)
            'selected_option_id' => 'required|exists:item_options,id',
            // Removed 'price_adjustment' validation
        ]);

        $imagePath = $product->image_path;
        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $imagePath = $request->file('image')->store('menu_item_images', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'image_path' => $imagePath,
        ]);

        $selectedOptionId = $request->input('selected_option_id');

        // Use sync with just the ID (in an array)
        $product->itemOptions()->sync([$selectedOptionId]);


        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $product) // Route model binding
    {
        // Delete the associated image if it exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
