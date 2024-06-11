<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function submitReview(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'message' => 'required|string|max:255',
        ]);
    
        // Создание нового отзыва
        $review = new Review();
        $review->name = Auth::user()->name; // Используем имя пользователя из аутентификации
        $review->email = Auth::user()->email; // Используем email пользователя из аутентификации
        $review->message = $request->input('message');
        $review->save();
    
        return redirect()->back()->with('success', 'Отзыв успешно отправлен.');
    }
    
}
