<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show($order_id)
    {
        $order = Order::with('items.product')->findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'This order has already been processed.');
        }

        return view('user.payment', compact('order'));
    }

    public function process(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'This order has already been processed.');
        }

        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,ewallet'
        ]);

        $order->update([
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid'
        ]);

        return redirect()->route('orders.index')->with('success', 'Payment successful! Your order is being processed.');
    }
}
