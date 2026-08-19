<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with([
            'user',
            'items.product'
        ])
        ->latest()
        ->get();

        return view('admin.orders.index', compact('orders'));
    }
}