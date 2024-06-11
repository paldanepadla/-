<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Добавляем импорт класса Auth

class NotificationController extends Controller
{   
    /**
     * Получает список уведомлений текущего пользователя.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();

        return response()->json(['notifications' => $notifications]);
    }
}
