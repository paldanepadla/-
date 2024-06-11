<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Импортируем модель Product

class ProfileController extends Controller
{
    public function index()
    {
        // Получаем первый продукт из базы данных
        $product = Product::first();

        // Передаем переменную $product в представление
        return view('profile.index', compact('product'));
    }
}

