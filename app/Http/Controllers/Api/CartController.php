<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add to Cart API
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = auth()->user();
        $productVariant = ProductVariant::find($request->product_variant_id);
        // Check if item is already in the cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
            ]);
        }

        return response()->json(['status'=> true,'message' => 'Product added to cart'], 201);

    }
    // List Cart API
    public function listCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('productVariant.product')
            ->get();

        return response()->json(['status'=> true,'message' => 'Data fetched successfully.','data'=> $cartItems], 201);

    }
    // Remove from Cart API
    public function removeFromCart($id)
    {
        $user = Auth::user();
        $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->first();

        if (!$cartItem) {
            return response()->json(['status'=> false,'message' => 'Item not found in cart'], 404);

        }

        $cartItem->delete();
        return response()->json(['status'=> true,'message' => 'Item removed from cart'], 201);

    }
}
