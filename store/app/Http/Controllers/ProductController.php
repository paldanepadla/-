<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

class ProductController extends Controller
{
    protected $cartController;
    protected $orderController;

    public function __construct(CartController $cartController, OrderController $orderController)
    {
        $this->cartController = $cartController;
        $this->orderController = $orderController;
    }

    public function deletePage()
    {
        $products = Product::all();
        return view('products.delete', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = $this->findProduct($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $this->updateCart($product);

        return redirect()->route('cart.index')->with('success', 'Продукт добавлен в корзину.');
    }

    public function index()
    {
        $products = Product::all();
        $cartItemCount = $this->cartController->getCartItemCount();
        $product = Product::first();
        $orderCount = $this->orderController->getOrderCount(); 

        return view('products.index', compact('products', 'product', 'cartItemCount', 'orderCount'));
    }
    

    public function create()
    {
        return view('products.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->get();
        }

        Product::create($validatedData);

        return redirect()->back()->with('success', 'Продукт успешно создан');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function getProductById($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Продукт не найден'], 404);
        }
    
        return response()->json($product);
    }
    
    public function index1()
    {
        $products = Product::all();
        return view('products.index1', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all();
        return view('products.edit', compact('product', 'products'));
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->get();
        }

        $product->save();

        return redirect()->back()->with('success', 'Продукт успешно обновлен');
    }    

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->noContent();
    }

    private function findProduct($productId)
    {
        return Product::find($productId);
    }

    private function updateCart($product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => base64_encode($product->image)
            ];
        }

        session()->put('cart', $cart);
    }
}
