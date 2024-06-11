<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Создание нового отзыва
        $review = new Review();
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->message = $request->input('message');
        $review->save();

        // Возвращаем успешный ответ или редирект
        return redirect()->back()->with('success', 'Отзыв успешно отправлен.');
    }
}
