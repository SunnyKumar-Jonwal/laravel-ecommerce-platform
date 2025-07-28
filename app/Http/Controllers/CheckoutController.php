<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get user's cart
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        // Calculate totals
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->current_price;
        });
        
        $shipping = 0; // Free shipping for now
        $tax = $subtotal * 0.18; // 18% tax
        $total = $subtotal + $shipping + $tax;
        
        // Get user addresses
        $addresses = $user->addresses;
        
        return view('frontend.checkout.index', compact('cart', 'subtotal', 'shipping', 'tax', 'total', 'addresses'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:user_addresses,id',
            'payment_method' => 'required|in:cod,razorpay,stripe'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = $cart->items->sum(function ($item) {
                return $item->quantity * $item->product->current_price;
            });
            
            $shipping = 0;
            $tax = $subtotal * 0.18;
            $total = $subtotal + $shipping + $tax;

            // Get the selected address
            $selectedAddress = $user->addresses()->find($request->address_id);
            if (!$selectedAddress) {
                return back()->with('error', 'Invalid address selected.');
            }

            // Convert address to array for JSON storage
            $addressData = [
                'first_name' => $selectedAddress->first_name,
                'last_name' => $selectedAddress->last_name,
                'address_line_1' => $selectedAddress->address_line_1,
                'address_line_2' => $selectedAddress->address_line_2,
                'city' => $selectedAddress->city,
                'state' => $selectedAddress->state,
                'postal_code' => $selectedAddress->postal_code,
                'country' => $selectedAddress->country,
                'phone' => $selectedAddress->phone,
            ];

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . time() . '-' . $user->id,
                'status' => 'pending',
                'total_amount' => $total,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'discount_amount' => 0,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'pending',
                'shipping_address' => $addressData,
                'billing_address' => $addressData,
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->current_price,
                    'subtotal' => $item->quantity * $item->product->current_price,
                ]);
            }

            // Clear cart
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('order.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Checkout error: ' . $e->getMessage());
            \Log::error('Checkout error trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.checkout.success', compact('order'));
    }
}
