<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Get the cart from the session
        $cart = Session::get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Determine the user (logged in or guest)
        $user = Auth::user();

        // --- Calculate the total amount and validate/prepare order items ---
        $totalAmount = 0;
        $orderItemsToSave = []; // Array to store order items before saving

        foreach ($cart as $cartItemId => $cartItem) {
            // Re-fetch the menu item to get its latest price and ensure it exists
            $menuItem = MenuItem::find($cartItem['menu_item_id']);

            // Validate: Ensure the menu item still exists
            if (!$menuItem) {

                return redirect()->route('cart.view')->with('error', 'One or more items in your cart are no longer available. Please review your cart.');
            }

            // Validate: Ensure quantity is valid
            if (!isset($cartItem['quantity']) || !is_numeric($cartItem['quantity']) || $cartItem['quantity'] < 1) {

                return redirect()->route('cart.view')->with('error', 'Invalid quantity for one or more items in your cart. Please review your cart.');
            }

            // Calculate item total using the price from the database at the time of order
            $itemTotal = $menuItem->price * $cartItem['quantity'];
            $totalAmount += $itemTotal;

            // Prepare order item data
            $orderItemsToSave[] = [
                'menu_item_id' => $menuItem->id,
                'quantity' => $cartItem['quantity'],
                'price' => $menuItem->price, // Use current price from DB
                // Add selected options from $cartItem if applicable (make sure they are structured correctly in the cart)
                // 'options' => json_encode($cartItem['options'] ?? null),
            ];
        }

        // --- Create the Order and Order Items in a Transaction ---
        try {
            DB::beginTransaction();

            $order = new Order();
            $order->user_id = $user ? $user->id : null;
            $order->total_amount = $totalAmount; // Use the calculated total
            $order->status = 'pending'; // Example initial status (you'll likely update this in a payment gateway integration)
            $order->save();

            // Attach order items to the newly created order
            foreach ($orderItemsToSave as $itemData) {
                $orderItem = new OrderItem($itemData); // Create OrderItem with data
                $orderItem->order_id = $order->id; // Set the order_id
                $orderItem->save();
            }


            DB::commit(); // Commit the transaction

            // --- Clear the cart after successful order placement ---
            Session::forget('cart');

            // --- Redirect to confirmation page ---
            return redirect()->route('order.confirmation', ['order' => $order->id])->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error

            // Redirect back to the cart view with a generic error message
            return redirect()->route('cart.view')->with('error', 'There was an error placing your order. Please try again.');
        }
    }
    public function showConfirmation(Order $order)
    {
        // Optional authorization check...

        // Load related order items and menu items
        $order->load('orderItems.menuItem');

        // Calculate total quantity
        $totalQuantity = 0;
        foreach ($order->orderItems as $item) {
            $totalQuantity += $item->quantity;
        }

        // Calculate estimated preparation time
        $preparationTimePerItem = 5; // Minutes per item
        $estimatedPreparationTime = $totalQuantity * $preparationTimePerItem;


        // Pass the order and the calculated estimate to the view
        return view('frontend.order.confirmation', compact('order', 'estimatedPreparationTime'));
    }

    public function showOrderHistory(Request $request) // Accept Request instance
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your order history.');
        }

        // Get the logged-in user
        $user = Auth::user();

        // Get the status filter from the query string, default to 'all'
        $statusFilter = $request->query('status', 'all');


        $query = $user->orders()->with('orderItems.menuItem', 'orderItems.itemOption')->latest(); // Added ->latest() for sorting

        // Apply the status filter if it's not 'all'
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }


        $orders = $query->get();

        // Pass the filtered orders and the status filter to the view
        return view('frontend.order.history', [
            'orders' => $orders, // Pass the single filtered collection
            'statusFilter' => $statusFilter, // Pass the filter value for the tabs
        ]);
    }
}
