<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItems = $cart->items()->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $product = MenuItem::findOrFail($product_id);
        $user = Auth::user();
        
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Append notes if any
            $newNotes = $cartItem->notes;
            if ($request->notes) {
                $newNotes = $newNotes ? $newNotes . ' | ' . $request->notes : $request->notes;
            }
            
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'notes' => $newNotes
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'notes' => $request->notes,
            ]);
        }

        return redirect()->route('cart.index')->with('success', "{$product->name} added to cart!");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        // Ensure user owns this cart item
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
