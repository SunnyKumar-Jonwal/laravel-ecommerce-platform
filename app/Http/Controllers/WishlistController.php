<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's wishlist
     */
    public function index()
    {
        $user = Auth::user();
        $wishlist = $user->getDefaultWishlist();
        $wishlistItems = $wishlist->items()->with('product.category', 'product.brand')->latest()->get();

        return view('frontend.wishlist.index', compact('wishlistItems', 'wishlist'));
    }

    /**
     * Add a product to wishlist
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
        $wishlist = $user->getDefaultWishlist();

        // Check if product already exists in wishlist
        $existingItem = $wishlist->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist!'
                ], 400);
            }
            
            return back()->with('error', 'Product is already in your wishlist!');
        }

        // Add to wishlist
        $wishlist->items()->create([
            'product_id' => $product->id
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist successfully!',
                'wishlist_count' => $wishlist->items()->count()
            ]);
        }

        return back()->with('success', 'Product added to wishlist successfully!');
    }

    /**
     * Remove a product from wishlist
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $wishlist = $user->getDefaultWishlist();

        $item = $wishlist->items()->where('product_id', $request->product_id)->first();

        if (!$item) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in wishlist!'
                ], 404);
            }
            
            return back()->with('error', 'Product not found in wishlist!');
        }

        $item->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist successfully!',
                'wishlist_count' => $wishlist->items()->count()
            ]);
        }

        return back()->with('success', 'Product removed from wishlist successfully!');
    }

    /**
     * Clear entire wishlist
     */
    public function clear()
    {
        $user = Auth::user();
        $wishlist = $user->getDefaultWishlist();

        $wishlist->items()->delete();

        return back()->with('success', 'Wishlist cleared successfully!');
    }

    /**
     * Get wishlist count
     */
    public function count()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $user = Auth::user();
        $wishlist = $user->getDefaultWishlist();

        return response()->json([
            'count' => $wishlist->items()->count()
        ]);
    }

    /**
     * Check if product is in wishlist
     */
    public function check(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        if (!Auth::check()) {
            return response()->json(['in_wishlist' => false]);
        }

        $user = Auth::user();
        $wishlist = $user->getDefaultWishlist();

        $inWishlist = $wishlist->items()->where('product_id', $request->product_id)->exists();

        return response()->json(['in_wishlist' => $inWishlist]);
    }

    /**
     * Move item from wishlist to cart
     */
    public function moveToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
        $wishlist = $user->getDefaultWishlist();

        // Check if product exists in wishlist
        $wishlistItem = $wishlist->items()->where('product_id', $product->id)->first();

        if (!$wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist!'
            ], 404);
        }

        try {
            // Simple approach: Remove from wishlist first
            $wishlistItem->delete();

            // Add to cart using a simpler approach  
            $cartController = new CartController();
            $cartRequest = new Request([
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            
            // Set proper headers for the cart request
            $cartRequest->headers = $request->headers;
            $cartResponse = $cartController->add($cartRequest);

            return response()->json([
                'success' => true,
                'message' => 'Product moved to cart successfully!',
                'wishlist_count' => $wishlist->items()->count()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error moving product to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while moving the product!'
            ], 500);
        }
    }
}
