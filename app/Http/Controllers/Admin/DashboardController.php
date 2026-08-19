<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = MenuItem::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalOrders', 'totalCategories'));
    }
}
