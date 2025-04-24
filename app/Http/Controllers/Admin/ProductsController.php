<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index()
    {
        $products = MenuItem::orderBy('name')->paginate(10); // Fetch products, order by name, add pagination

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // If you have categories, you might fetch them here:
        // $categories = \App\Models\Category::all();
        // return view('admin.products.create', compact('categories'));

        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'inventory' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // 2. Handle image upload (if an image was provided)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store in 'storage/app/public/menu_item_images' (or similar)
            $imagePath = $request->file('image')->store('menu_item_images', 'public');
        }

        // 3. Create the new MenuItem
        $product = MenuItem::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            // You might want to generate the slug here or have a mutator in your model
            'slug' => Str::slug($request->name), // Example using Str::slug
            'description' => $request->description,
            'ingredients' => $request->ingredients, // Added based on migration
            'price' => $request->price,
            'inventory' => $request->inventory,
            'image_path' => $imagePath, // Store the image path in the database
        ]);

        // 4. Redirect the user with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


    public function show(MenuItem $product) // Route model binding automatically fetches the product
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $product) // Route Model Binding
    {
        $categories = Category::all(); // Fetch all categories
        return view('admin.products.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $product)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'inventory' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // Nullable allows updating without uploading a new image
        ]);

        // 2. Handle image upload (if a new image was provided)
        $imagePath = $product->image_path; // Keep the old path by default
        if ($request->hasFile('image')) {
            // Delete the old image if it exists in storage/app/public
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('menu_item_images', 'public');
        }

        // 3. Update the MenuItem
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            // Update slug if needed or let a mutator handle it
            'slug' => Str::slug($request->name), // Example
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'image_path' => $imagePath, // Update with the new path (or the old one)
        ]);

        // 4. Redirect the user with a success message
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
