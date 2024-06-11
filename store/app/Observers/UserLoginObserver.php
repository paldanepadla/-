<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\User;

class UserLoginObserver
{
    /**
     * Обрабатывает успешный вход пользователя.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function loggedIn(User $user)
    {
        // Создаем уведомление при успешном входе пользователя
        $user->notifications()->create([
            'message' => 'Добро пожаловать, ' . $user->name . '! Вы успешно вошли в систему. Оплата заказа происходит при получении. Хорошего шоппинга!'
        ]);
    }
}
