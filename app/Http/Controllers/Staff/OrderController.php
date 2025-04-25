<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');

        $query = Order::query();

        // **Add filter to get orders from the current month**
        // Get the start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);


        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Apply sorting based on status
        if ($statusFilter === 'pending') {
            // Sort pending orders by creation date ASC
            $query->orderBy('created_at', 'asc');
        } else {
            // Default sorting for other statuses (e.g., newest first)
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(15);

        // Optional: Fetch counts for the tabs if you want to display them
        // $pendingOrdersCount = Order::where('status', 'pending')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        // $cookingOrdersCount = Order::where('status', 'cooking')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        // $completedOrdersCount = Order::where('status', 'completed')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        // $canceledOrdersCount = Order::where('status', 'canceled')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();


        return view('staff.orders.index', [
            'orders' => $orders,
            'statusFilter' => $statusFilter,
            // Pass counts here if needed (remember to apply the monthly filter here too)
            // 'pendingOrdersCount' => $pendingOrdersCount,
            // 'cookingOrdersCount' => $cookingOrdersCount,
            // 'completedOrdersCount' => $completedOrdersCount,
            // 'canceledOrdersCount' => $canceledOrdersCount,
        ]);
    }





    public function accept(Order $order)
    {
        // Add authorization check here if needed (e.g., can this staff accept orders?)

        if ($order->status === 'pending') {
            $order->status = 'cooking'; // Update status to 'cooking'
            $order->save();

            // You might want to add a success message
            return Redirect::back()->with('success', 'Order #' . $order->id . ' accepted and marked as cooking.');
        }

        // Handle cases where the order is not pending (optional)
        return Redirect::back()->with('error', 'Order #' . $order->id . ' cannot be accepted.');
    }

    /**
     * Deny a pending order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deny(Order $order)
    {
        // Add authorization check here

        if ($order->status === 'pending') {
            $order->status = 'canceled'; // Update status to 'canceled'
            $order->save();

            // You might want to add a success message
            return Redirect::back()->with('success', 'Order #' . $order->id . ' denied and marked as canceled.');
        }

        // Handle cases where the order is not pending (optional)
        return Redirect::back()->with('error', 'Order #' . $order->id . ' cannot be denied.');
    }

    /**
     * Mark a cooking order as completed.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Order $order)
    {
        // Add authorization check here

        if ($order->status === 'cooking') {
            $order->status = 'completed'; // Update status to 'completed'
            $order->save();

            // You might want to add a success message
            return Redirect::back()->with('success', 'Order #' . $order->id . ' marked as completed.');
        }

        // Handle cases where the order is not cooking (optional)
        return Redirect::back()->with('error', 'Order #' . $order->id . ' cannot be completed.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {

        $order->load('orderItems.menuItem', 'orderItems.itemOption');



        return view('staff.orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
