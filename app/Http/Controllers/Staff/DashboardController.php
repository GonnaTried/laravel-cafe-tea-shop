<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() // Assuming this is the method for your staff dashboard
    {
        // Get the start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch the counts from the database, filtered by the current month
        $pendingOrdersCount = Order::where('status', 'pending')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        // Assuming 'preparing' is a valid status based on your counts
        $preparingOrdersCount = Order::where('status', 'preparing')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        $completedOrdersCount = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        // Add counts for other statuses if needed (e.g., canceled)
        $canceledOrdersCount = Order::where('status', 'canceled')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        // You might also fetch counts for products, users (e.g., new users this month) etc. if needed,
        // applying similar date filters if desired.

        // Pass the counts to the dashboard view
        return view('staff.dashboard', [ // Make sure 'staff.dashboard' is the correct view path
            'pendingOrdersCount' => $pendingOrdersCount,
            'preparingOrdersCount' => $preparingOrdersCount,
            'completedOrdersCount' => $completedOrdersCount,
            'canceledOrdersCount' => $canceledOrdersCount, // Pass canceled count if fetched
            // Pass other counts here
        ]);
    }
}
