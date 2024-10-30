<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CustomizeImageController extends Controller
{
    public function saveCanvasImage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'image_data' => 'required|string',
            'final_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id',
            'product_title' => 'required|string',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.']);
        }

        try {
            // Extract and decode the image data
            $imageData = $request->input('image_data');
            $finalPrice = $request->input('final_price');
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageData = base64_decode($image);

            // Define the file name and path
            $fileName = 'design_' . time() . '.png';
            $filePath = public_path('uploads/' . $fileName);

            // Create the uploads directory if it doesn't exist
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0777, true);
            }

            // Save the decoded image data to a file
            file_put_contents($filePath, $imageData);

            // Check if the product already exists in the cart
            $cart = Cart::where('user_id', $user->id)
                         ->where('product_id', $request->input('product_id'))
                         ->first();

            if ($cart) {
                // Delete the old customized design if exists
                if ($cart->custImage) {
                    $oldImagePath = public_path($cart->custImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Remove the old image file
                    }
                }

                // Update the existing cart item
                $cart->custImage = 'uploads/' . $fileName;
                $cart->price = $finalPrice;
                $cart->quantity = $request->input('quantity');
                $cart->product_title = $request->input('product_title');
                $cart->save();
            } else {
                // If no existing cart item, create a new one
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->custImage = 'uploads/' . $fileName;
                $cart->price = $finalPrice;
                $cart->quantity = $request->input('quantity');
                $cart->product_id = $request->input('product_id');
                $cart->product_title = $request->input('product_title');
                $cart->save();
            }

            // Set a success message in the session
            session()->flash('success', 'Design saved successfully to your cart.');

            // Redirect to the cart
            return response()->json([
                'success' => true,
                'redirect_url' => route('cart')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save back design. Error: ' . $e->getMessage()]);
        }
    }



public function checkExistingCartItem(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
    ]);

    $exists = Cart::where('user_id', auth()->id())
                   ->where('product_id', $request->input('product_id'))
                   ->exists();

    return response()->json(['exists' => $exists]);
}


}
