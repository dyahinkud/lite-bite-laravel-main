<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalOrders = Order::where('customer_name', $user->username)->count();
        return view('user.dashboard', compact('user', 'totalOrders'));
    }
}
