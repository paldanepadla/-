<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Observers\UserLoginObserver; 

class LoginController extends Controller
{
    // Ваш другой код...

    /**
     * Обрабатывает запрос на вход пользователя.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Получаем аутентифицированного пользователя

            // Вызываем метод loggedIn вашего UserLoginObserver
            app(UserLoginObserver::class)->loggedIn($user); // Вот здесь возможна ошибка

            if ($user->email === 'admin@admin' && $request->password === '12345678') {
                return redirect()->route('profile.index');
            }
    
            return redirect('/');
        }

        // Авторизация не удалась
        return redirect()->back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ]);
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    /**
     * Обрабатывает запрос на выход пользователя.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
