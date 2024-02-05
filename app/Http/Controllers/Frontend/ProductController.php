<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ImageProduct;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'imageProduct')->latest()->paginate(6);
        // dd($products);  
        return view('frontend.homepage', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('category', 'imageProduct')->find($id);
        return view('frontend.detail', compact('product'));
    }

    public function checkout($id) 
    {
        $order = Order::with('product')->where('product_id', $id)->first();
        
        return view('frontend.checkout-page', compact('order'));    
    }

    public function order(Request $request)
    {
        // dd($request->all());
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $productPrice = $request->input('product_price');
        $subtotal = $request->input('product_price') * $request->input('quantity');

        $order = new Order();
        $order->product_id = $productId;
        $order->quantity = $quantity;
        $order->subtotal = $subtotal;
        $order->save();

        return redirect()->route('homepage.checkout', ['id' => $productId]);
    }

    public function processOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string',
            'town_city' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|string',
            'phone_number' => 'required|string',
            'order_notes' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'product_id' => 'required|integer|min:1',
            'subtotal' => 'required|integer|min:0',
            'shipping' => 'nullable|boolean',
            'payment_method' => 'required|string|in:transfer,cash_on_delivery,paypal',
        ]);

        $transaction = Transaction::create($request->all());
        return redirect()->route('checkout.success', ['id' => $transaction->id]);
    }

    public function success($id)
    {
        // Retrieve the transaction by ID
        $transaction = Transaction::find($id);

        // Check if the transaction exists
        if (!$transaction) {
            abort(404); // You can customize this based on your error handling strategy
        }

        return view('frontend.success', ['transaction' => $transaction]);
    }


}

