<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    // Add an item to the cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            // Add validation for options if applicable
        ]);

        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $quantity = $request->quantity;


        // Get the current cart from the session or initialize an empty array
        $cart = Session::get('cart', []);


        $cartItemId = $menuItem->id; // Simple key



        // Check if the item is already in the cart
        if (array_key_exists($cartItemId, $cart)) {
            // If item exists, update the quantity
            $cart[$cartItemId]['quantity'] += $quantity;
        } else {
            // If item is not in the cart, add it
            $cart[$cartItemId] = [
                'menu_item_id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => $quantity,

            ];
        }

        // Store the updated cart back in the session
        Session::put('cart', $cart);

        $previousUrl = URL::previous();

        if (str_contains($previousUrl, '/viewItem')) {
            // If coming from a viewItem page, redirect to the cart view
            return redirect('/home')->with('success', $menuItem->name . ' has been added to your cart!');
        } else {
            return back();
        }
    }

    // View the cart contents
    public function viewCart()
    {
        $cart = Session::get('cart', []);

        // You might want to load the actual MenuItem models here to get full details (images, etc.)
        // Example:
        $cartItemsWithDetails = [];
        $total = 0;
        foreach ($cart as $cartItem) {
            $menuItem = MenuItem::find($cartItem['menu_item_id']);
            if ($menuItem) {
                $cartItemsWithDetails[] = [
                    'item' => $menuItem,
                    'quantity' => $cartItem['quantity'],
                    // Include options if applicable
                ];
                $total += $menuItem->price * $cartItem['quantity'];
            }
        }


        return view('frontend.cart.index', compact('cart')); // Pass the cart array to the view
        // Or if you loaded details: return view('frontend.cart.index', compact('cartItemsWithDetails', 'total'));
    }

    public function removeCartItem(string $cartItemId) // Accepts the cartItemId from the route
    {
        $cart = Session::get('cart', []);

        // Check if the item exists in the cart
        if (array_key_exists($cartItemId, $cart)) {
            // Remove the item
            unset($cart[$cartItemId]);

            // Store the updated cart back in the session
            Session::put('cart', $cart);

            // Redirect back to the cart view with a success message
            // You can use the item name if you stored it in the session
            $itemName = $cart[$cartItemId]['name'] ?? 'Item'; // Get name before removing if possible
            return redirect()->route('cart.view')->with('success', $itemName . ' has been removed from your cart.');
        }

        // Redirect back to the cart view with an error if the item was not found
        return redirect()->route('cart.view')->with('error', 'Item not found in cart.');
    }
}
