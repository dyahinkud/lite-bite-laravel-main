<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil order yang sudah dibayar beserta item dan produknya
        $query = Order::with('items.product')
            ->where('payment_status', 'paid');

        $filter = $request->input('filter', 'all');

        // Filter berdasarkan waktu
        if ($filter === 'today') {
            $query->whereDate('created_at', today());

        } elseif ($filter === 'this_week') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);

        } elseif ($filter === 'this_month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        // Total revenue
        $totalRevenue = (clone $query)->sum('total_price');

        // Total orders
        $totalOrders = (clone $query)->count();

        // Data orders untuk tabel
        $orders = $query
            ->orderBy('created_at', 'desc')
            ->get();

        // ==========================================
        // Chart 1: Revenue per Product (Top 7)
        // ==========================================

        $revenueByProduct = $orders
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->groupBy(function ($item) {
                return $item->product->name ?? 'Unknown';
            })
            ->map(function ($items) {
                return $items->sum(function ($item) {
                    return $item->price * $item->quantity;
                });
            })
            ->sortDesc()
            ->take(7);

        // ==========================================
        // Chart 2: Orders by Payment Method
        // ==========================================

        $ordersByMethod = $orders
            ->groupBy('payment_method')
            ->map(function ($group) {
                return $group->count();
            });

        return view(
            'admin.reports.index',
            compact(
                'orders',
                'totalRevenue',
                'totalOrders',
                'filter',
                'revenueByProduct',
                'ordersByMethod'
            )
        );
    }
}