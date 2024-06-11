<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    public function index()
    {
        $orders = session()->get('orders', []);
        $cartController = new CartController();
        $cartItemCount = $cartController->getCartItemCount();
        $user = Auth::user();
        
        // Проходимся по всем заказам и изменяем время на 5 часов вперед
        foreach ($orders as &$order) {
            $order['date'] = Carbon::parse($order['date'])->addHours(5)->format('Y-m-d H:i:s');
        }
        
        return view('orders.index', compact('orders', 'cartItemCount', 'user'));
    }

    public function placeOrder(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }

        $orders = session()->get('orders', []);
        $orders[] = [
            'items' => $cartItems,
            'date' => Carbon::now()->format('d.m.Y H:i')
        ];

        session()->put('orders', $orders);
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Ваш заказ успешно размещен.');
    }
    
    public function cancel($index)
    {
        $orders = session()->get('orders', []);
    
        // Если заказ с указанным индексом существует, удаляем его из массива.
        if (isset($orders[$index])) {
            unset($orders[$index]);
        }
    
        // Обновляем данные в сессии.
        session()->put('orders', $orders);
    
        // Возвращаем пользователя на страницу с заказами с сообщением об успешной отмене заказа.
        return redirect()->route('orders.index')->with('success', 'Заказ успешно отменен.');
    }
    
    public function getOrderCount()
    {
        // Получаем все заказы из сессии
        $orders = Session::get('orders', []);

        // Подсчитываем количество заказов
        $orderCount = count($orders);

        return $orderCount;
    }
}
