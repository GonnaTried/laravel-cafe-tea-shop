<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Double;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Customer Users
        $totalCustomerCount = User::count();

        // Total Products (assuming MenuItem represents products)
        $totalProductCount = MenuItem::count();

        // New Customer User Registrations This Month
        $newUserCountMonthly = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Total Income This Month from COMPLETED orders
        $totalIncomeMonthly = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'completed')
            ->sum('total_amount');


        // --- Pass Data to the View ---

        return view('admin.dashboard', [
            'totalCustomerCount' => $totalCustomerCount,
            'totalProductCount' => $totalProductCount,
            'newUserCountMonthly' => $newUserCountMonthly,
            'totalIncomeMonthly' => $totalIncomeMonthly,
        ]);
    }
}
