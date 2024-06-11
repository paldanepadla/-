<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\OrderController;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $cartItemCount = $this->getCartItemCount(); // Получение количества товаров в корзине
        $orderCount = (new OrderController())->getOrderCount(); // Получение количества заказов
        
        return view('cart.index', compact('cartItems', 'totalPrice', 'cartItemCount', 'orderCount'));
    }
            
    public function getCartItemCount()
    {
        $cartItems = session()->get('cart', []);
        $totalItems = 0;

        foreach ($cartItems as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }
    
    
    public function add(Request $request)
    {
        $product = Product::find($request->input('product_id'));

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('home')->with('success', 'Product added to cart.');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function checkout(Request $request)
    {
        $cartItems = session()->get('cart', []);
        $orders = session()->get('orders', []);
        
        $orders[] = [
            'items' => $cartItems,
            'date' => now()->format('d.m.Y H:i')
        ];
    
        session()->put('orders', $orders);
        session()->forget('cart');
    
        return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
    }    
    
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
