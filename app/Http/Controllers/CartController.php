<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You cannot access the cart if you are not logged in');
        }
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();
        return view('cart', compact('cart'));
    }
    // Show the product details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Shuffle other products for "Customers Also Bought These" section
        $shuffle = Product::inRandomOrder()->take(4)->get(); // Adjust the count as needed

        return view('product-details', compact('product', 'shuffle'));
    }

    // Add product to cart
    public function addToCart(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
    }

    $product = Product::findOrFail($id);

    // Validate quantity input
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // \Log::info('Attempting to add to cart', [
    //     'user_id' => Auth::id(),
    //     'product_id' => $product->id,
    //     'quantity' => $request->quantity,
    // ]);

    try {
        // Create a new Cart instance
        $cartItem = new Cart();
        $cartItem->user_id = Auth::id();
        $cartItem->product_id = $product->id;
        $cartItem->name = Auth::user()->name;
        $cartItem->email = Auth::user()->email;
        $cartItem->phone = Auth::user()->phone;
        $cartItem->product_title = $product->title;
        $cartItem->price = $product->price;
        $cartItem->image = $product->main_image;
        $cartItem->quantity = $request->quantity;

        // Save the cart item
        $cartItem->save();

        // \Log::info('Cart Item Saved:', $cartItem->toArray());

        return redirect()->route('product-details', ['id' => $id])->with('success', 'Product added to cart successfully');
    } catch (\Exception $e) {
        // \Log::error('Error adding to cart: ' . $e->getMessage());
        return redirect()->route('product-details', ['id' => $id])->with('error', 'Failed to add product to cart.');
    }
}

    public function checkout() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You cannot access the checkout if you are not logged in');
        }
        $totalAmount = session('total_amount');
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();

        // Check if the cart is empty
        if ($cart->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        // Calculate total amount
        $totalAmount = $cart->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout', compact('cart', 'totalAmount'));
    }
    // In your Controller or middleware, depending on your setup
    public function cartCount()
    {
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        return response()->json(['cartCount' => $cartCount]);
    }
    public function destroy(string $id)
    {
        $cart = cart::findOrFail($id);

        //Soft Delete
        $cart->delete();

        // Force Delete
        // $cart->forceDelete();

        return redirect()->back();
    }
}
