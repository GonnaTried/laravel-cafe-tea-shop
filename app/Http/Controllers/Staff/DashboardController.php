<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the counts from the database
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $preparingOrdersCount = Order::where('status', 'preparing')->count();
        $completedOrdersCount = Order::where('status', 'completed')->count();
        // You might also fetch counts for products, users, etc. if needed

        // Pass the counts to the dashboard view
        return view('staff.dashboard', [ // Or 'staff.dashboard' if that's the correct path
            'pendingOrdersCount' => $pendingOrdersCount,
            'preparingOrdersCount' => $preparingOrdersCount,
            'completedOrdersCount' => $completedOrdersCount,
            // Pass other counts here
        ]);
    }
}
