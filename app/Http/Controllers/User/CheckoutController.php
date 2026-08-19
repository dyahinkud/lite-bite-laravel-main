<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.checkout', compact('cartItems', 'subtotal', 'user'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cartItems = $cart->items()->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // 1. Create the main Order
        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $user->username,
            'phone' => $user->email,
            'total_price' => $totalPrice,
            'payment_status' => 'pending',
            'payment_method' => null,
        ]);

        // 2. Create Order Items and move data from Cart Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price, // Snapshot current price
                'notes' => $item->notes,
            ]);
        }

        // 3. Clear the Cart
        $cart->items()->delete();

        return redirect()->route('payment.show', ['order_id' => $order->id]);
    }
}
